<?php

namespace App\Http\Livewire\TemanPengurus\Dashboard;

use App\Models\TemanPengurus\Pengurus;
use Livewire\Component;

class TotalPengurus extends Component
{
    public $total = 0;

    protected $listeners = [
        'PengurusIndex' => '$refresh',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = Pengurus::query();

        $this->total = $query->count();
    }
    public function render()
    {
        return view('livewire.teman-pengurus.dashboard.total-pengurus');
    }
}
