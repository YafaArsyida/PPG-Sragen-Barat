<?php

namespace App\Http\Livewire\Operasional\KegiatanEvent;

use App\Models\Desa;
use App\Models\KegiatanGenerus;
use App\Models\PresensiKegiatanGenerus;
use Livewire\Component;

class Report extends Component
{
    public $kegiatan;
    public $kegiatanId;
    public $ms_desa_id;
    public $nama_desa = '-';
    public $totalInfaq = 0;

    public $laporanRows = [];

    public $grandTotal = [
        'target_l' => 0,
        'target_p' => 0,
        'target_total' => 0,

        'hadir_l' => 0,
        'hadir_p' => 0,
        'hadir_total' => 0,

        'alfa' => 0,
    ];

    protected $listeners = [
        'KegiatanReport' => 'loadReport'
    ];

    public function loadReport($kegiatanId, $desaId)
    {
        $this->resetReport();
        $this->kegiatanId = $kegiatanId;
        $this->ms_desa_id = $desaId;

        // DESA
        $desa = Desa::find($desaId);
        $this->nama_desa = $desa?->nama_desa ?? '-';

        // KEGIATAN
        $this->kegiatan = KegiatanGenerus::with([
            'ms_desa',
            'ms_kelompok'
        ])->find($kegiatanId);

        if (!$this->kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);

            return;
        }

        // GENERATE REPORT
        $this->generateTableReport();

        // CHILD COMPONENT
        $this->emitTo(
            'operasional.kegiatan-event.attendance',
            'setKegiatan',
            $kegiatanId,
            $desaId
        );

        // SUCCESS
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Laporan kegiatan berhasil dimuat'
        ]);
    }

    // GENERATE TABLE REPORT
    private function generateTableReport()
    {
        if (!$this->kegiatan) {
            return;
        }
        // TOTAL INFAQ
        $this->totalInfaq = $this->kegiatan
            ->tr_infaq()
            ->sum('nominal');

        // TARGET PESERTA
        $targetQuery = $this->kegiatan
            ->targetPesertaQuery()
            ->with([
                'ms_kelompok.ms_desa'
            ]);

        // Filter desa jika ada
        if ($this->ms_desa_id) {
            $targetQuery->whereHas('ms_kelompok', function ($q) {
                $q->where('ms_desa_id', $this->ms_desa_id);
            });
        }

        $targetGenerus = $targetQuery->get();
        // PRESENSI
        $presensi = PresensiKegiatanGenerus::with([
            'ms_generus.ms_kelompok'
        ])
            ->where('ms_kegiatan_generus_id', $this->kegiatanId)
            ->where('status_hadir', 'hadir')
            ->get();

        // GROUP TARGET
        $groupedTarget = $targetGenerus
            ->groupBy('ms_kelompok_id');

        // GROUP PRESENSI
        $groupedPresensi = $presensi
            ->groupBy('ms_generus.ms_kelompok_id');

        $rows = [];

        $grand = [
            'target_l' => 0,
            'target_p' => 0,
            'target_total' => 0,

            'hadir_l' => 0,
            'hadir_p' => 0,
            'hadir_total' => 0,

            'alfa' => 0,

        ];

        // LOOP KELOMPOK
        foreach ($groupedTarget as $kelompokId => $members) {
            $kelompok = optional($members->first())->ms_kelompok;

            // TARGET
            $targetL = $members
                ->where('jenis_kelamin', 'laki-laki')
                ->count();

            $targetP = $members
                ->where('jenis_kelamin', 'perempuan')
                ->count();

            $targetTotal = $targetL + $targetP;

            // PRESENSI HADIR
            $hadirCollection = $groupedPresensi[$kelompokId]
                ?? collect();

            $hadirL = $hadirCollection
                ->filter(function ($item) {

                    return optional($item->ms_generus)
                        ->jenis_kelamin === 'laki-laki';
                })
                ->count();

            $hadirP = $hadirCollection
                ->filter(function ($item) {

                    return optional($item->ms_generus)
                        ->jenis_kelamin === 'perempuan';
                })
                ->count();

            $hadirTotal = $hadirL + $hadirP;

            // ALFA
            $alfa = max(0, $targetTotal - $hadirTotal);

            // PRESENTASE
            $presentase = $targetTotal > 0
                ? round(($hadirTotal / $targetTotal) * 100)
                : 0;

            $rows[] = [
                'kelompok' => strtoupper(
                    $kelompok?->nama_kelompok ?? '-'
                ),

                'target_l' => $targetL,
                'target_p' => $targetP,
                'target_total' => $targetTotal,

                'hadir_l' => $hadirL,
                'hadir_p' => $hadirP,
                'hadir_total' => $hadirTotal,

                'alfa' => $alfa,

                'presentase' => $presentase,
            ];

            // GRAND TOTAL
            $grand['target_l'] += $targetL;
            $grand['target_p'] += $targetP;
            $grand['target_total'] += $targetTotal;

            $grand['hadir_l'] += $hadirL;
            $grand['hadir_p'] += $hadirP;
            $grand['hadir_total'] += $hadirTotal;

            $grand['alfa'] += $alfa;
        }

        // SORT BY PRESENTASE DESC
        usort($rows, function ($a, $b) {
            return $b['presentase'] <=> $a['presentase'];
        });

        // SET STATE
        $this->laporanRows = $rows;
        $this->grandTotal = $grand;
    }

    // RESET REPORT
    private function resetReport()
    {
        $this->laporanRows = [];

        $this->totalInfaq = 0;

        $this->grandTotal = [
            'target_l' => 0,
            'target_p' => 0,
            'target_total' => 0,

            'hadir_l' => 0,
            'hadir_p' => 0,
            'hadir_total' => 0,

            'alfa' => 0,
        ];
    }

    // COMPUTED
    public function getPersentaseGlobalProperty()
    {
        if ($this->grandTotal['target_total'] == 0) {
            return 0;
        }

        return round(
            (
                $this->grandTotal['hadir_total']
                /
                $this->grandTotal['target_total']
            ) * 100
        );
    }

    // RENDER
    public function render()
    {
        return view('livewire.operasional.kegiatan-event.report');
    }
}
