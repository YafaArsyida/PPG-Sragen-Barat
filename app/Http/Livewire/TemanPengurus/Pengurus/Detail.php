<?php

namespace App\Http\Livewire\TemanPengurus\Pengurus;

use App\Models\TemanPengurus\PenempatanDapukan;
use App\Models\TemanPengurus\Pengurus;
use Livewire\Component;

class Detail extends Component
{
    public $ms_pengurus_id;

    public $pengurus;

    public $listPenempatan = [];

    protected $listeners = [
        'PengurusDetail',
    ];

    public function PengurusDetail($id)
    {
        $this->ms_pengurus_id = $id;

        $this->loadPengurus();

        $this->loadPenempatan();
    }

    public function loadPengurus()
    {
        $this->pengurus = Pengurus::with([
            'ms_kelompok.ms_desa'
        ])->findOrFail(
            $this->ms_pengurus_id
        );
    }

    public function loadPenempatan()
    {
        $this->listPenempatan = PenempatanDapukan::with([
            'ms_dapukan'
        ])
            ->where(
                'ms_pengurus_id',
                $this->ms_pengurus_id
            )
            ->latest()
            ->get();
    }
    public function render()
    {
        return view('livewire.teman-pengurus.pengurus.detail');
    }
}
