<?php

namespace App\Http\Livewire\TemanPengurus\KegiatanPengurus;

use App\Models\TemanPengurus\KegiatanPengurus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    public $kegiatanId = null;

    protected $listeners = [
        'KegiatanDelete'
    ];

    public function KegiatanDelete($kegiatanId)
    {
        $this->kegiatanId = $kegiatanId;
    }

    public function deleteKegiatan()
    {
        if (!$this->kegiatanId) return;

        $kegiatan = KegiatanPengurus::find($this->kegiatanId);

        // if ($kegiatan->presensis()->exists()) {
        //     $this->dispatchBrowserEvent('alertify-error', [
        //         'message' => 'Kegiatan sudah memiliki data presensi.'
        //     ]);
        //     return;
        // }

        if (!$kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }

        DB::beginTransaction();
        try {
            $kegiatan->delete(); // support soft delete jika pakai SoftDeletes
            DB::commit();

            // Tutup modal
            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'KegiatanDelete'
            ]);

            // Refresh index
            $this->emit('KegiatanIndex');

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Kegiatan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.teman-pengurus.kegiatan-pengurus.delete');
    }
}
