<?php

namespace App\Http\Livewire\AspekKurikulum;

use App\Models\AspekKurikulum;
use App\Models\MateriKurikulum;
use Livewire\Component;

class Delete extends Component
{
    public $ms_aspek_kurikulum_id;

    public $nama_aspek;

    protected $listeners = [
        'AspekDelete'
    ];

    public function AspekDelete($id)
    {
        $aspek = AspekKurikulum::findOrFail($id);

        $this->ms_aspek_kurikulum_id = $aspek->ms_aspek_kurikulum_id;
        $this->nama_aspek = $aspek->nama_aspek;
    }

    public function delete()
    {
        if (!$this->ms_aspek_kurikulum_id) {
            return;
        }

        // VALIDASI MATERI
        $existMateri = MateriKurikulum::where(
            'ms_aspek_kurikulum_id', $this->ms_aspek_kurikulum_id
        )->exists();

        if ($existMateri) {

            $this->dispatchBrowserEvent(
                'alertify-error', ['message' => 'Aspek tidak dapat dihapus karena masih memiliki materi aktif.']
            );

            return;
        }

        AspekKurikulum::where(
            'ms_aspek_kurikulum_id',
            $this->ms_aspek_kurikulum_id
        )->delete();

        $this->dispatchBrowserEvent(
            'hide-modal', ['modalId' => 'DeleteAspek']
        );

        $this->emit('AspekIndex');

        $this->dispatchBrowserEvent(
            'alertify-success', ['message' => 'Aspek kurikulum berhasil dihapus!']
        );
    }
    public function render()
    {
        return view('livewire.aspek-kurikulum.delete');
    }
}
