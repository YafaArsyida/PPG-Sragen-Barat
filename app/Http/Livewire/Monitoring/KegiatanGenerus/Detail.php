<?php

namespace App\Http\Livewire\Monitoring\KegiatanGenerus;

use App\Models\Generus;
use App\Models\PresensiKegiatanGenerus;
use Carbon\Carbon;
use Livewire\Component;

class Detail extends Component
{
    public $generus = null;
    public $presensi = [];

    public $generusId = null;

    public $periode = '1bulan';

    protected $listeners = [
        'DetailKegiatanGenerus' => 'loadDetail',
    ];

    public function loadDetail($generusId)
    {
        // Simpan ID generus
        $this->generusId = $generusId;

        // Ambil data generus
        $this->generus = Generus::with([
            'ms_kelompok.ms_desa',
        ])->find($generusId);

        if (!$this->generus) {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data Generus tidak ditemukan'
            ]);

            return;
        }

        // Ambil presensi berdasarkan periode
        $this->loadPresensi();

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Riwayat kehadiran ditampilkan'
        ]);
    }

    /**
     * Reload ketika periode berubah
     */
    public function updatedPeriode()
    {
        if ($this->generusId) {
            $this->loadPresensi();
        }
    }

    /**
     * Ambil presensi berdasarkan periode
     */
    private function loadPresensi()
    {
        $end = Carbon::now()->endOfDay();

        switch ($this->periode) {

            case '3bulan':
                $start = Carbon::now()
                    ->subMonths(3)
                    ->startOfDay();
                break;

            case '1tahun':
                $start = Carbon::now()
                    ->subYear()
                    ->startOfDay();
                break;

            case '1bulan':
            default:
                $start = Carbon::now()
                    ->subMonth()
                    ->startOfDay();
                break;
        }

        $this->presensi = PresensiKegiatanGenerus::with([
                'ms_kegiatan_generus',
            ])
            ->where('ms_generus_id', $this->generusId)
            ->whereBetween('tanggal_presensi', [
                $start->toDateString(),
                $end->toDateString(),
            ])
            ->orderByDesc('tanggal_presensi')
            ->orderByDesc('waktu_hadir')
            ->get();
    }

    public function render()
    {
        return view('livewire.monitoring.kegiatan-generus.detail');
    }
}
