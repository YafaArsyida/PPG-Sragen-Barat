<?php

namespace App\Http\Livewire\Parameter;

use App\Models\JenjangKurikulum;
use App\Models\Kelompok;
use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PeriodeJenjangKelompokKurikulum extends Component
{
    public $selectedPeriode = null;
    public $selectedJenjang = null;
    public $selectedKelompok = null;

    public function mount()
    {
        $user = Auth::user();

        // PERIODE DEFAULT
        $this->selectedPeriode = PeriodeKurikulum::query()
            ->where('status', 'aktif')
            ->value('ms_periode_kurikulum_id');

        // JENJANG DEFAULT
        $this->selectedJenjang = JenjangKurikulum::query()
            ->value('ms_jenjang_kurikulum_id');

        // SUPERADMIN
        if ($user->peran === 'SUPERADMIN') {
            $this->selectedKelompok = Kelompok::query()
                ->value('ms_kelompok_id');

            return;
        }

        // USER KELOMPOK
        $this->selectedKelompok = $user->ms_kelompok_id;
    }

    public function updatedSelectedPeriode()
    {
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedJenjang()
    {
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedKelompok()
    {
        $this->checkAndEmitParameters();
    }

    private function checkAndEmitParameters()
    {
        if (
            $this->selectedPeriode &&
            $this->selectedJenjang &&
            $this->selectedKelompok
        ) {

            $this->emit('parameterKurikulumUpdated', [

                'periode' => $this->selectedPeriode,

                'jenjang' => $this->selectedJenjang,

                'kelompok' => $this->selectedKelompok,

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
        $this->selectedKelompok = null;

        $this->emit('parameterKurikulumUpdated', null);
    }


    public function render()
    {
        $user = Auth::user();

        return view('livewire.parameter.periode-jenjang-kelompok-kurikulum',[
            'select_periode' => PeriodeKurikulum::query()
                ->orderByDesc('tanggal_mulai')
                ->get(),

            'select_jenjang' => JenjangKurikulum::query()
                ->orderBy('nama_jenjang')
                ->get(),

            'select_kelompok' => $user->peran === 'SUPERADMIN'
                ? Kelompok::query()->orderBy('nama_kelompok')->get()
                : Kelompok::query()->where('ms_kelompok_id',$user->ms_kelompok_id)->get(),
        ]);
    }
}
