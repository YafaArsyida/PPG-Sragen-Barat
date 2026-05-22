<?php

namespace App\Http\Livewire\TemanPengurus\KegiatanPengurus;

use App\Models\TemanPengurus\KegiatanPengurus;
use Livewire\Component;

class Detail extends Component
{
    public $kegiatan;

    protected $listeners = [
        'KegiatanDetail'
    ];

    public function KegiatanDetail($kegiatanId)
    {
        $this->kegiatan = KegiatanPengurus::find($kegiatanId);

        if (!$this->kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Detail kegiatan ditampilkan'
        ]);
    }

    public function render()
    {
        return view('livewire.teman-pengurus.kegiatan-pengurus.detail');
    }
}
