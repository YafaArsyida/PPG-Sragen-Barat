<?php

namespace App\Http\Livewire\PeriodeKurikulum;

use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    public $periodeId;

    protected $listeners = [
        'PeriodeDelete' => 'loadData'
    ];

    public function loadData($id)
    {
        $this->periodeId = $id;
    }

    public function delete()
    {
        if (!$this->periodeId) {
            return;
        }

        DB::beginTransaction();

        try {

            $periode = PeriodeKurikulum::findOrFail(
                $this->periodeId
            );

            /*
            |--------------------------------------------------------------------------
            | VALIDASI RELASI
            |--------------------------------------------------------------------------
            | Nanti bisa ditambahkan:
            | - aspek kurikulum
            | - laporan kurikulum
            | - materi
            |--------------------------------------------------------------------------
            */

            // OPTIONAL:
            // if ($periode->aspeks()->exists()) {
            //     throw new \Exception(
            //         'Periode masih memiliki data aspek kurikulum'
            //     );
            // }

            $periode->delete();

            DB::commit();

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'PeriodeDelete'
            ]);

            $this->emit('PeriodeIndex');

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Periode berhasil dihapus!'
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
        return view('livewire.periode-kurikulum.delete');
    }
}
