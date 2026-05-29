<?php

namespace App\Http\Livewire\Parameter;

use App\Models\JenjangKurikulum;
use App\Models\PeriodeKurikulum;
use Livewire\Component;

class PeriodeJenjangKurikulum extends Component
{
    public $selectedPeriode = null;
    public $selectedJenjang = null;

    public function mount()
    {
        $this->selectedPeriode = PeriodeKurikulum::query()
            ->where('status', 'aktif')
            ->value('ms_periode_kurikulum_id');

        $this->selectedJenjang = JenjangKurikulum::query()
            ->value('ms_jenjang_kurikulum_id');
    }

    public function updatedSelectedPeriode()
    {
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedJenjang()
    {
        $this->checkAndEmitParameters();
    }

    private function checkAndEmitParameters()
    {
        if (
            $this->selectedPeriode &&
            $this->selectedJenjang
        ) {

            $this->emit('parameterKurikulumUpdated', [
                'periode' => $this->selectedPeriode,
                'jenjang' => $this->selectedJenjang,
            ]);

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Memperbarui kurikulum...'
            ]);
        }
    }

    public function refreshParameters()
    {
        $this->selectedPeriode = null;
        $this->selectedJenjang = null;

        $this->emit('parameterKurikulumUpdated', null);
    }

    public function render()
    {
        return view('livewire.parameter.periode-jenjang-kurikulum',[
            'select_periode' => PeriodeKurikulum::query()
                ->orderByDesc('tanggal_mulai')
                ->get(),

            'select_jenjang' => JenjangKurikulum::query()
                ->orderBy('nama_jenjang')
                ->get(),
        ]);
    }
}
