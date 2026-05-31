<?php

namespace App\Http\Livewire\MonitoringKurikulum;

use App\Models\Kelompok;
use App\Models\MateriKurikulum;
use App\Models\PenilaianMateriKurikulum;
use Livewire\Component;

class Report extends Component
{
    public $ms_jenjang_kurikulum_id;
    public $ms_desa_id;
    public $ms_periode_kurikulum_id;

    public function render()
    {
        $kelompoks = Kelompok::query()
            ->where('ms_desa_id', $this->ms_desa_id)
            ->orderBy('nama_kelompok')
            ->get();

        $materis = MateriKurikulum::query()
            ->join(
                'ms_aspek_kurikulum',
                'ms_materi_kurikulum.ms_aspek_kurikulum_id',
                '=',
                'ms_aspek_kurikulum.ms_aspek_kurikulum_id'
            )
            ->where(
                'ms_aspek_kurikulum.ms_jenjang_kurikulum_id',
                $this->ms_jenjang_kurikulum_id
            )
            ->where(
                'ms_aspek_kurikulum.ms_periode_kurikulum_id',
                $this->ms_periode_kurikulum_id
            )
            ->select('ms_materi_kurikulum.*')
            ->orderBy('urutan')
            ->get();

        $penilaians = PenilaianMateriKurikulum::query()
            ->where(
                'ms_periode_kurikulum_id',
                $this->ms_periode_kurikulum_id
            )
            ->where(
                'ms_jenjang_kurikulum_id',
                $this->ms_jenjang_kurikulum_id
            )
            ->get()
            ->keyBy(function ($item) {
                return $item->ms_kelompok_id . '_' . $item->ms_materi_kurikulum_id;
            });

        $avgKehadiranKelompok = [];
        $avgKeberhasilanKelompok = [];

        foreach ($kelompoks as $kelompok) {

            $avgKehadiranKelompok[$kelompok->ms_kelompok_id] =
                PenilaianMateriKurikulum::query()
                ->where(
                    'ms_periode_kurikulum_id',
                    $this->ms_periode_kurikulum_id
                )
                ->where(
                    'ms_jenjang_kurikulum_id',
                    $this->ms_jenjang_kurikulum_id
                )
                ->where(
                    'ms_kelompok_id',
                    $kelompok->ms_kelompok_id
                )
                ->avg('kehadiran') ?? 0;

            $avgKeberhasilanKelompok[$kelompok->ms_kelompok_id] =
                PenilaianMateriKurikulum::query()
                ->where(
                    'ms_periode_kurikulum_id',
                    $this->ms_periode_kurikulum_id
                )
                ->where(
                    'ms_jenjang_kurikulum_id',
                    $this->ms_jenjang_kurikulum_id
                )
                ->where(
                    'ms_kelompok_id',
                    $kelompok->ms_kelompok_id
                )
                ->avg('keberhasilan') ?? 0;
        }

        $grandAvgKehadiran = PenilaianMateriKurikulum::query()
            ->where(
                'ms_periode_kurikulum_id',
                $this->ms_periode_kurikulum_id
            )
            ->where(
                'ms_jenjang_kurikulum_id',
                $this->ms_jenjang_kurikulum_id
            )
            ->avg('kehadiran') ?? 0;

        $grandAvgKeberhasilan = PenilaianMateriKurikulum::query()
            ->where(
                'ms_periode_kurikulum_id',
                $this->ms_periode_kurikulum_id
            )
            ->where(
                'ms_jenjang_kurikulum_id',
                $this->ms_jenjang_kurikulum_id
            )
            ->avg('keberhasilan') ?? 0;

        return view('livewire.monitoring-kurikulum.report',[
            'kelompoks' => $kelompoks,
            'materis' => $materis,
            'penilaians' => $penilaians,

            'avgKehadiranKelompok' => $avgKehadiranKelompok,
            'avgKeberhasilanKelompok' => $avgKeberhasilanKelompok,

            'grandAvgKehadiran' => $grandAvgKehadiran,
            'grandAvgKeberhasilan' => $grandAvgKeberhasilan,
        ]);
    }
}
