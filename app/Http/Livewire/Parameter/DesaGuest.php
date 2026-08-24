<?php

namespace App\Http\Livewire\Parameter;

use App\Models\Desa;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DesaGuest extends Component
{
    public $selectedDesa = null;

    private function getDesaQuery()
    {
        return Desa::query();
    }

    public function mount()
    {
        $this->selectedDesa = $this->getDesaQuery()
            ->orderBy('nama_desa')
            ->value('ms_desa_id');
    }

    public function updatedSelectedDesa()
    {
        $this->checkAndEmitParameters();
    }

    private function checkAndEmitParameters()
    {
        if ($this->selectedDesa !== null) {
            $this->emit('parameterUpdated', $this->selectedDesa);
            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Memperbarui...']);
        }
    }

    public function refreshParameters()
    {
        $this->selectedDesa = null;
        $this->emit('parameterUpdated', null);
    }

    public function render()
    {
        return view('livewire.parameter.desa-guest',[
             'select_desa' => $this->getDesaQuery()
                ->orderBy('nama_desa')
                ->get(),
        ]);
    }
}
