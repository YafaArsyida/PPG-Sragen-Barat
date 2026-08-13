<?php

namespace App\Http\Livewire\Monitoring\KegiatanGenerus;

use App\Models\Kelompok;
use App\Models\PresensiKegiatanGenerus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedDesa = null;
    
    public $searchGenerus = '';
    public $selectedKelompok = '';
    public $periode = '1bulan';

    public $listKelompok = [];
   
    protected $listeners = [
        'parameterUpdated' => 'setDesa'
    ];

    public function setDesa($desaId)
    {
        $this->selectedDesa = $desaId;
        $this->loadKelompok();
        $this->resetPage();
    }

    public function loadKelompok()
    {
        if (!$this->selectedDesa) {
            $this->listKelompok = [];
            return;
        }

        $this->listKelompok = Kelompok::where('ms_desa_id', $this->selectedDesa)
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function updatedSearchGenerus()
    {
        $this->resetPage();
    }

    public function updatedSelectedKelompok()
    {
        $this->resetPage();
    }

    public function updatedPeriode()
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

        $query = PresensiKegiatanGenerus::query()
            ->select(
                'ms_generus_id',
                DB::raw('COUNT(*) as total_hadir')
            )
            ->with(['ms_generus.ms_kelompok'])
            ->whereBetween('tanggal_presensi', [$start, $end])
            ->where('status_hadir', 'hadir');

        // Guard clause
        if (!$this->selectedDesa) {
            return $query->whereRaw('1 = 0');
        }

        // Filter desa
        $query->whereHas('ms_generus.ms_kelompok', function ($q) {
            $q->where('ms_desa_id', $this->selectedDesa);
        });

        // Filter nama generus
        if ($this->searchGenerus) {
            $search = '%' . $this->searchGenerus . '%';

            $query->whereHas('ms_generus', function ($q) use ($search) {
                $q->where('nama_generus', 'like', $search);
            });
        }

        // Filter kelompok
        if ($this->selectedKelompok) {
            $query->whereHas('ms_generus', function ($q) {
                $q->where('ms_kelompok_id', $this->selectedKelompok);
            });
        }

        return $query
            ->groupBy('ms_generus_id')
            ->orderByDesc('total_hadir');
    }

    public function render()
    {
        return view('livewire.monitoring.kegiatan-generus.index',[
            'data' => $this->data->paginate(20)
        ]);
    }
}
