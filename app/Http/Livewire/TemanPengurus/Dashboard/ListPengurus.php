<?php

namespace App\Http\Livewire\TemanPengurus\Dashboard;

use App\Models\TemanPengurus\Pengurus;
use Livewire\Component;
use Livewire\WithPagination;

class ListPengurus extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getPengurusProperty()
    {
        $query = Pengurus::with('ms_kelompok.ms_desa');

        // Search
        if ($this->search) {
            $query->where('nama_pengurus', 'like', "%{$this->search}%");
        }

        return $query->orderBy('nama_pengurus')->paginate(20);
    }

    public function render()
    {
        return view('livewire.teman-pengurus.dashboard.list-pengurus',[
            'data' => $this->pengurus
        ]);
    }
}
