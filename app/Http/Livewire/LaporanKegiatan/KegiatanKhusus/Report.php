<?php

namespace App\Http\Livewire\LaporanKegiatan\KegiatanKhusus;

use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use App\Models\PresensiKegiatanGenerus;
use App\Models\TRInfaq;
use Carbon\Carbon;
use Livewire\Component;

class Report extends Component
{
    public $kegiatan;
    public $kegiatanId;
    public $ms_desa_id;
    public $nama_desa = '-';

    public $search = '';

    public $targetTotal = 0;
    public $persentaseTotal = 0;
    public $totalInfaq = 0;

    public $laporanRows = [];
    public $tanggalMatrix = [];
    public $totalPerTanggal = [];

    protected $listeners = [
        'ReportKhusus' => 'loadReport',
    ];

    public function updatedSearch()
    {
        $this->generateTableReport();
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Memperbarui'
        ]);
    }

    public function loadReport($kegiatanId)
    {
        $this->resetReport();

        $this->kegiatanId = $kegiatanId;

        $this->kegiatan = KegiatanGenerus::with([
            'ms_desa',
        ])->find($kegiatanId);

        if (!$this->kegiatan) {
            return;
        }

        $this->ms_desa_id = $this->kegiatan->ms_desa_id;
        $this->nama_desa  = $this->kegiatan->ms_desa->nama_desa;

        $this->generateTableReport();

        $this->emitTo(
            'laporan-kegiatan.kegiatan-khusus.attendance',
            'setKegiatan',
            $kegiatanId,
        );

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Laporan kegiatan berhasil dimuat'
        ]);
    }

    private function generateTanggalMatrix()
    {
        return collect($this->kegiatan->jadwal_khusus ?? [])
            ->pluck('tanggal')
            ->sort()
            ->values()
            ->toArray();
    }
    private function resetReport()
    {
        $this->search = '';

        $this->laporanRows = [];
        $this->tanggalMatrix = [];
        $this->totalPerTanggal = [];
    }
    private function generateTableReport()
    {
        if (!$this->kegiatanId) {
            return;
        }

        $kelompoks = Kelompok::query()
            ->where('ms_desa_id', $this->ms_desa_id)

            ->when($this->search, function ($query) {
                $query->where(
                    'nama_kelompok',
                    'like',
                    '%' . $this->search . '%'
                );
            })

            ->withCount('ms_generus')
            ->orderBy('nama_kelompok')
            ->get();

        // $targetTotal = $kelompoks->sum('ms_generus_count');
        $this->targetTotal = $kelompoks->sum('ms_generus_count');

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
            ->whereIn(
                'tanggal_presensi',
                $this->tanggalMatrix
            )
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
                'target'   => $target,
                'tanggal'  => [],
                'persen'   => [],
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
                    'hadir'      => $hadir,
                    'persentase' => $persentase,
                ];

                // agar mudah dipanggil di blade
                $row['persen'][$tanggal] = $persentase;
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
                'persentase' => $this->targetTotal > 0
                    ? round(($hadirTotal / $this->targetTotal) * 100)
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
            ->where('ms_kegiatan_generus_id',$this->kegiatanId)
            ->get()
            ->groupBy(function($item){

                return Carbon::parse(
                    $item->tanggal
                )->format('Y-m-d');

            });

        foreach($this->tanggalMatrix as $tanggal){
            $this->totalPerTanggal[$tanggal]['infaq'] =
                ($infaqs[$tanggal] ?? collect())
                    ->sum('nominal');
        }
        
        $this->totalInfaq = collect($this->totalPerTanggal)
           ->sum('infaq');
        /*
        |--------------------------------------------------------------------------
        | Persentase Keseluruhan
        |--------------------------------------------------------------------------
        */
        $totalHadir = collect($this->totalPerTanggal)
            ->sum('hadir');

        $totalTarget = $this->targetTotal * count($this->tanggalMatrix);

        $this->persentaseTotal = $totalTarget > 0
            ? round(($totalHadir / $totalTarget) * 100)
            : 0;
    }
    public function render()
    {
        return view('livewire.laporan-kegiatan.kegiatan-khusus.report');
    }
}
