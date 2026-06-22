<?php

namespace App\Http\Livewire\Operasional\KegiatanRutin;

use App\Models\Desa;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use App\Models\PresensiKegiatanGenerus;
use App\Models\TRInfaq;
use Livewire\Component;

class Report extends Component
{
    public $kegiatan;
    public $kegiatanId;
    public $ms_desa_id;
    public $nama_desa = '-';

    public $startDate = null;
    public $endDate = null;

    public $laporanRows = [];
    public $tanggalMatrix = [];
    public $totalPerTanggal = [];

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');
    }

     public function resetTanggal()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');

        $this->generateTableReport();

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode diperbarui'
        ]);
    }

     public function updatedStartDate()
    {
        $this->generateTableReport();

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode diperbarui'
        ]);
    }

    public function updatedEndDate()
    {
       $this->generateTableReport();

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode diperbarui'
        ]);
    }

    protected $listeners = [
        'KegiatanReport' => 'loadReport',
    ];

    public function loadReport($kegiatanId)
    {
        $this->resetReport();
        $this->kegiatanId = $kegiatanId;
         $this->kegiatan = KegiatanGenerus::with([
            'ms_desa',
            'ms_kelompok'
        ])->find($kegiatanId);

        $this->ms_desa_id = $this->kegiatan?->ms_desa_id ?? null;

        $this->nama_desa = $this->kegiatan?->ms_desa?->nama_desa ?? '-';

        if (!$this->kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }

        $this->generateTableReport();

         $this->emitTo(
            'operasional.kegiatan-rutin.attendance',
            'setKegiatan',
            $kegiatanId,
        );

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Laporan kegiatan berhasil dimuat'
        ]);
    }

    private function resetReport()
    {
        $this->kegiatan = null;
        $this->laporanRows = [];
        $this->tanggalMatrix = [];
        $this->totalPerTanggal = [];
    }

    private function generateTanggalMatrix()
    {
        $mapHari = [
            'minggu' => Carbon::SUNDAY,
            'senin'  => Carbon::MONDAY,
            'selasa' => Carbon::TUESDAY,
            'rabu'   => Carbon::WEDNESDAY,
            'kamis'  => Carbon::THURSDAY,
            'jumat'  => Carbon::FRIDAY,
            'sabtu'  => Carbon::SATURDAY,
        ];

        $hariRutin = $this->kegiatan->hari_rutin ?? [];

        $tanggal = [];

        $start = Carbon::parse($this->startDate);
        $end   = Carbon::parse($this->endDate);

        while ($start->lte($end)) {

            foreach ($hariRutin as $hari) {

                if (
                    isset($mapHari[$hari]) &&
                    $start->dayOfWeek === $mapHari[$hari]
                ) {
                    $tanggal[] = $start->format('Y-m-d');
                    break;
                }
            }

            $start->addDay();
        }

        return $tanggal;
    }

    private function generateTableReport()
    {
        if (
            !$this->kegiatanId ||
            !$this->startDate ||
            !$this->endDate ||
            Carbon::parse($this->endDate)->lt(Carbon::parse($this->startDate))
        ) {
            return;
        }

        $kelompoks = Kelompok::query()
            ->where('ms_desa_id', $this->ms_desa_id)
            ->withCount('ms_generus')
            ->orderBy('nama_kelompok')
            ->get();

        $targetTotal = $kelompoks->sum('ms_generus_count');

        /*
        |--------------------------------------------------------------------------
        | Tanggal Presensi (Kolom Tabel)
        |--------------------------------------------------------------------------
        */
        $this->tanggalMatrix = $this->generateTanggalMatrix();

        /*
        |--------------------------------------------------------------------------
        | Semua Presensi
        |--------------------------------------------------------------------------
        */
        $presensis = PresensiKegiatanGenerus::query()
            ->with('ms_generus')
            ->where('ms_kegiatan_generus_id', $this->kegiatanId)
            ->where('status_hadir', 'hadir')
            ->whereBetween('tanggal_presensi', [
                $this->startDate,
                $this->endDate
            ])
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Presensi Map
        |--------------------------------------------------------------------------
        */
        $presensiMap = $presensis
            ->filter(fn($item) => $item->ms_generus)
            ->groupBy(function ($item) {

                return
                    $item->ms_generus->ms_kelompok_id .
                    '|' .
                    Carbon::parse(
                        $item->tanggal_presensi
                    )->format('Y-m-d');
            });

        /*
        |--------------------------------------------------------------------------
        | Total Hadir Per Tanggal
        |--------------------------------------------------------------------------
        */
        $hadirPerTanggal = $presensis
            ->groupBy(function ($item) {
                return Carbon::parse(
                    $item->tanggal_presensi
                )->format('Y-m-d');
            })
            ->map(fn($items) => $items->count());

        /*
        |--------------------------------------------------------------------------
        | Rows Kelompok
        |--------------------------------------------------------------------------
        */
        $rows = [];

        foreach ($kelompoks as $kelompok) {

            $target = $kelompok->ms_generus_count;

            $row = [
                'kelompok' => strtoupper($kelompok->nama_kelompok),
                'target' => $target,
                'tanggal' => [],
            ];

            foreach ($this->tanggalMatrix as $tanggal) {

                $hadir = count(
                    $presensiMap[
                        $kelompok->ms_kelompok_id . '|' . $tanggal
                    ] ?? []
                );

                $persentase = $target > 0
                    ? round(($hadir / $target) * 100)
                    : 0;

                $row['tanggal'][$tanggal] = [
                    'hadir' => $hadir,
                    'persentase' => $persentase,
                ];
            }

            $rows[] = $row;
        }

        $this->laporanRows = $rows;

        /*
        |--------------------------------------------------------------------------
        | Footer Total Per Tanggal
        |--------------------------------------------------------------------------
        */
        foreach ($this->tanggalMatrix as $tanggal) {

            $hadirTotal = $hadirPerTanggal[$tanggal] ?? 0;

            $this->totalPerTanggal[$tanggal] = [
                'hadir' => $hadirTotal,
                'persentase' => $targetTotal > 0
                    ? round(($hadirTotal / $targetTotal) * 100)
                    : 0,
                'infaq' => 0,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Infaq Per Tanggal
        |--------------------------------------------------------------------------
        */
        $infaqs = TRInfaq::query()
            ->where('ms_kegiatan_generus_id', $this->kegiatanId)
            ->whereBetween('tanggal', [
                $this->startDate,
                $this->endDate
            ])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse(
                    $item->tanggal
                )->format('Y-m-d');
            });

        foreach ($this->tanggalMatrix as $tanggal) {

            $this->totalPerTanggal[$tanggal]['infaq'] =
                ($infaqs[$tanggal] ?? collect())
                    ->sum('nominal');
        }
    }
    public function render()
    {
        return view('livewire.operasional.kegiatan-rutin.report');
    }

}
