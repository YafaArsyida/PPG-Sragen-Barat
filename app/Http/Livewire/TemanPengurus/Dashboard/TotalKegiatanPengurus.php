<?php

namespace App\Http\Livewire\TemanPengurus\Dashboard;

use App\Models\TemanPengurus\KegiatanPengurus;
use Livewire\Component;

class TotalKegiatanPengurus extends Component
{
    public $totalKegiatan = 0;

    protected $listeners = [
        'KegiatanIndex' => '$refresh',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = KegiatanPengurus::query();

        $this->totalKegiatan = $query->count();
    }
    public function render()
    {
        return view('livewire.teman-pengurus.dashboard.total-kegiatan-pengurus');
    }
}
