<?php

namespace App\Http\Livewire\JenjangKurikulum;

use App\Models\JenjangKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    public $jenjangId;

    protected $listeners = [
        'JenjangDelete' => 'loadData'
    ];

    public function loadData($id)
    {
        $this->jenjangId = $id;
    }

    public function delete()
    {
        if (!$this->jenjangId) {
            return;
        }

        DB::beginTransaction();

        try {

            $jenjang = JenjangKurikulum::findOrFail(
                $this->jenjangId
            );

            /*
        |--------------------------------------------------------------------------
        | VALIDASI RELASI
        |--------------------------------------------------------------------------
        | Cegah hapus jika masih dipakai aspek/materi
        |--------------------------------------------------------------------------
        */

            // OPTIONAL FUTURE VALIDATION
            // if ($jenjang->aspeks()->exists()) {
            //     throw new \Exception(
            //         'Jenjang masih memiliki data aspek kurikulum'
            //     );
            // }

            $jenjang->delete();

            DB::commit();

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'JenjangDelete'
            ]);

            $this->emit('JenjangIndex');

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Jenjang berhasil dihapus!'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => $e->getMessage()
            ]);
        }
    }
    public function render()
    {
        return view('livewire.jenjang-kurikulum.delete');
    }
}
