<?php

namespace App\Http\Livewire\TemanPengurus\Pengurus;

use App\Models\TemanPengurus\Dapukan;
use App\Models\TemanPengurus\Pengurus;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $gender = '';
    public $ms_dapukan_id = '';

    public $listDapukan = [];

    protected $listeners = [
        'PengurusIndex' => '$refresh',
        'DapukanIndex' => 'loadDapukan',
    ];

    public function mount()
    {
        $this->loadDapukan();
    }

    public function loadDapukan()
    {
        $this->listDapukan = Dapukan::orderBy('nama_dapukan')->get();
    }

    public function getQueryProperty(){
        $query = Pengurus::query()
        ->with(['ms_kelompok'])
        ->withCount(['ms_penempatan_dapukan']);

        if ($this->search) {
            $query->where('nama_pengurus', 'like', "%{$this->search}%");
        }
        if ($this->gender) {
            $query->where('jenis_kelamin', $this->gender);
        }
        // Filter dapukan
        if ($this->ms_dapukan_id) {
            $query->whereHas('ms_penempatan_dapukan', function ($q) {
                $q->where('ms_dapukan_id', $this->ms_dapukan_id);
            });
        }
        return $query;
    }
    
    public function render()
    {
        return view('livewire.teman-pengurus.pengurus.index',[
            'data' => $this->query->paginate(100)
        ]);
    }
}
