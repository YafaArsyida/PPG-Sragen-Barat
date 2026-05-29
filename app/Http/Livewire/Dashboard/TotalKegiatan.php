<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\KegiatanGenerus;
use Livewire\Component;

class TotalKegiatan extends Component
{
    public $selectedDesa = null;
    public $totalKegiatan = 0;

    protected $listeners = [
        'parameterUpdated',
        'KegiatanIndex' => '$refresh',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function parameterUpdated($desaId)
    {
        $this->selectedDesa = $desaId;
        $this->loadData();
    }

    public function loadData()
    {
        // Guard clause
        if (!$this->selectedDesa) {
            $this->totalKegiatan = 0;
            return;
        }

        $query = KegiatanGenerus::query()
            ->where('ms_desa_id', $this->selectedDesa);
    
        $this->totalKegiatan = $query->count();
    }
    public function render()
    {
        return view('livewire.dashboard.total-kegiatan');
    }
}
