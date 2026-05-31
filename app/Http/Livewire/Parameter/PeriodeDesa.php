<?php

namespace App\Http\Livewire\Parameter;

use App\Models\Desa;
use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PeriodeDesa extends Component
{
    public $selectedPeriode = null;
    public $selectedDesa = null;

    public function mount()
    {
        $user = Auth::user();

        // PERIODE AKTIF
        $this->selectedPeriode = PeriodeKurikulum::query()
            ->where('status', 'aktif')
            ->value('ms_periode_kurikulum_id');

        // SUPERADMIN
        if ($user->peran === 'SUPERADMIN') {

            $this->selectedDesa = Desa::query()
                ->value('ms_desa_id');

            return;
        }

        // USER DESA
        $this->selectedDesa = $user->ms_desa_id;
    }

    public function updatedSelectedPeriode()
    {
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedDesa()
    {
        $this->checkAndEmitParameters();
    }

    private function checkAndEmitParameters()
    {
        if (
            $this->selectedPeriode &&
            $this->selectedDesa
        ) {

            $this->emit('parameterMonitoringKbmUpdated', [

                'periode' => $this->selectedPeriode,

                'desa' => $this->selectedDesa,

            ]);

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Memperbarui monitoring KBM...'
            ]);
        }
    }

    public function refreshParameters()
    {
        $this->selectedPeriode = null;
        $this->selectedDesa = null;

        $this->emit('parameterMonitoringKbmUpdated', null);
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.parameter.periode-desa',[
            'select_periode' => PeriodeKurikulum::query()
                ->orderByDesc('tanggal_mulai')
                ->get(),

            'select_desa' => $user->peran === 'SUPERADMIN'

                ? Desa::query()
                ->orderBy('nama_desa')
                ->get()

                : Desa::query()
                ->where('ms_desa_id', $user->ms_desa_id)
                ->get(),
        ]);
    }
}
