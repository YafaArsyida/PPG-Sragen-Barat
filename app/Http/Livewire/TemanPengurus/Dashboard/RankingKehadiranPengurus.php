<?php

namespace App\Http\Livewire\TemanPengurus\Dashboard;

use App\Models\TemanPengurus\PresensiKegiatanPengurus;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class RankingKehadiranPengurus extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $periode = '1bulan'; // default

    public function updatingPeriode()
    {
        $this->resetPage();
    }

    private function getRangeTanggal()
    {
        return match ($this->periode) {
            '1bulan' => [now()->subMonth(), now()],
            '3bulan' => [now()->subMonths(3), now()],
            '1tahun' => [now()->subYear(), now()],
            default  => [now()->subMonth(), now()],
        };
    }

    public function getDataProperty()
    {
        [$start, $end] = $this->getRangeTanggal();

        return PresensiKegiatanPengurus::query()
            ->select(
                'ms_pengurus_id',
                DB::raw('COUNT(*) as total_hadir')
            )
            ->with(['ms_pengurus.ms_kelompok'])
            ->whereBetween('tanggal_presensi', [$start, $end])
            ->where('status_hadir', 'hadir')
            ->groupBy('ms_pengurus_id')
            ->orderByDesc('total_hadir')
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.teman-pengurus.dashboard.ranking-kehadiran-pengurus',[
            'data' => $this->data
        ]);
    }
}
