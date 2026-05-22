<?php

namespace App\Http\Livewire\TemanPengurus\Pengurus;

use App\Models\TemanPengurus\PenempatanDapukan;
use App\Models\TemanPengurus\Pengurus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    public $pengurusId = null;

    protected $listeners = [
        'PengurusDelete'
    ];

    public function PengurusDelete($pengurusId)
    {
        $this->pengurusId = $pengurusId;
    }

    public function delete()
    {
        if (!$this->pengurusId) return;
        $pengurus = Pengurus::find($this->pengurusId);

        if (!$pengurus) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data pengurus tidak ditemukan.'
            ]);
            return;
        }

        $exists = PenempatanDapukan::where('ms_pengurus_id', $this->pengurusId)
            ->exists();

        if ($exists) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Pengurus sudah memiliki penempatan dapukan.'
            ]);
            return;
        }

        DB::beginTransaction();
        try {
            $pengurus->delete(); // support soft delete jika pakai SoftDeletes
            DB::commit();

            // Tutup modal
            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'PengurusDelete'
            ]);

            // Refresh index
            $this->emit('PengurusIndex');

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
        return view('livewire.teman-pengurus.pengurus.delete');
    }
}
