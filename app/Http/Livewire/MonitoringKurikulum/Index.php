<?php

namespace App\Http\Livewire\MonitoringKurikulum;

use App\Models\JenjangKurikulum;
use App\Models\Kelompok;
use App\Models\MateriKurikulum;
use App\Models\PenilaianMateriKurikulum;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'parameterMonitoringKbmUpdated' => 'loadData'
    ];

    public $selectedPeriode;
    public $selectedDesa;

    public function loadData($parameter)
    {
        $this->selectedPeriode = $parameter['periode'];
        $this->selectedDesa = $parameter['desa'];
    }

    public function render()
    {
        $jumlahKelompok = Kelompok::query()
            ->where('ms_desa_id', $this->selectedDesa)
            ->count();

        $jenjangs = JenjangKurikulum::query()
            ->orderBy('nama_jenjang')
            ->get()
            ->map(function ($item) use ($jumlahKelompok) {

                $item->jumlah_kelompok = $jumlahKelompok;

                $item->jumlah_materi = MateriKurikulum::query()
                    ->join(
                        'ms_aspek_kurikulum',
                        'ms_materi_kurikulum.ms_aspek_kurikulum_id',
                        '=',
                        'ms_aspek_kurikulum.ms_aspek_kurikulum_id'
                    )
                    ->where(
                        'ms_aspek_kurikulum.ms_jenjang_kurikulum_id',
                        $item->ms_jenjang_kurikulum_id
                    )
                    ->where(
                        'ms_aspek_kurikulum.ms_periode_kurikulum_id',
                        $this->selectedPeriode
                    )
                    ->count();

                $queryPenilaian = PenilaianMateriKurikulum::query()
                    ->join(
                        'ms_kelompok',
                        'trx_penilaian_materi.ms_kelompok_id',
                        '=',
                        'ms_kelompok.ms_kelompok_id'
                    )
                    ->where(
                        'trx_penilaian_materi.ms_periode_kurikulum_id',
                        $this->selectedPeriode
                    )
                    ->where(
                        'trx_penilaian_materi.ms_jenjang_kurikulum_id',
                        $item->ms_jenjang_kurikulum_id
                    )
                    ->where(
                        'ms_kelompok.ms_desa_id',
                        $this->selectedDesa
                    );

                $item->avg_kehadiran = round(
                    (clone $queryPenilaian)->avg('kehadiran') ?? 0,
                    1
                );

                $item->avg_keberhasilan = round(
                    (clone $queryPenilaian)->avg('keberhasilan') ?? 0,
                    1
                );

                return $item;
            });

        return view('livewire.monitoring-kurikulum.index', [
            'jenjangs' => $jenjangs,
        ]);
    }
}
