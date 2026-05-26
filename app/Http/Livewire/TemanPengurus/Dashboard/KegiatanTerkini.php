<?php

namespace App\Http\Livewire\TemanPengurus\Dashboard;

use App\Models\TemanPengurus\KegiatanPengurus;
use App\Models\TemanPengurus\PresensiKegiatanPengurus;
use Livewire\Component;

class KegiatanTerkini extends Component
{
    public $selectedKegiatan = null;

    public $listKegiatan = [];

    public $hadir = 0;
    public $izin = 0;
    public $alfa = 0;

    public function mount()
    {
        $this->loadKegiatan();
    }

    public function updatedSelectedKegiatan()
    {
        $this->loadSummary();
    }

    private function loadKegiatan()
    {
        $this->listKegiatan = KegiatanPengurus::query()
            ->whereBetween('tanggal', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])
            ->orderBy('waktu')
            ->get();
    }

    private function loadSummary()
    {
        if (!$this->selectedKegiatan) {
            $this->resetSummary();
            return;
        }

        $query = PresensiKegiatanPengurus::where('ms_kegiatan_pengurus_id', $this->selectedKegiatan);

        $this->hadir = (clone $query)->where('status_hadir', 'hadir')->count();
        $this->izin = (clone $query)->where('status_hadir', 'izin')->count();
    }

    private function resetSummary()
    {
        $this->hadir = 0;
        $this->izin = 0;
        $this->alfa = 0;
    }
    public function render()
    {
        return view('livewire.teman-pengurus.dashboard.kegiatan-terkini');
    }
}
