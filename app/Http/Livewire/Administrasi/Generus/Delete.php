<?php

namespace App\Http\Livewire\Administrasi\Generus;

use App\Models\Generus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    public $generusId;

    protected $listeners = ['GenerusDelete'];

    /**
     * Terima ID Generus dari tombol
     */
    public function GenerusDelete($generusId)
    {
        $this->generusId = $generusId;
    }

    /**
     * Hapus Data Generus
     */
    public function deleteGenerus()
    {
        if (!$this->generusId) return;

        DB::beginTransaction();

        try {

            $generus = Generus::withCount('presensi_kegiatan_generus')
                ->lockForUpdate()
                ->find($this->generusId);

            if (!$generus) {

                DB::rollBack();

                $this->dispatchBrowserEvent('alertify-error', [
                    'message' => 'Data generus tidak ditemukan'
                ]);

                return;
            }

            // CEK PRESENSI
            if ($generus->presensi_kegiatan_generus_count > 0) {

                DB::rollBack();

                $this->dispatchBrowserEvent('alertify-error', [
                    'message' => 'Generus tidak dapat dihapus karena sudah memiliki riwayat presensi'
                ]);

                return;
            }

            $generus->delete();

            DB::commit();

            // CLOSE MODAL
            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'ModalDeleteGenerus'
            ]);

            // REFRESH
            $this->emit('GenerusIndex');

            // SUCCESS
            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Generus berhasil dihapus!'
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
        return view('livewire.administrasi.generus.delete');
    }
}
