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
        $user = Auth::user();

        // AKSES PUBLIK
        if (!$user) {
            return Desa::query();
        }

        $aksesPengguna = $user->ms_akses_pengguna;

        if ($aksesPengguna->isEmpty()) {
            return Desa::query()->whereRaw('1 = 0');
        }

        $query = Desa::query();

        $query->where(function ($q) use ($aksesPengguna) {

            foreach ($aksesPengguna as $akses) {

                switch ($akses->scope_type) {

                    // akses daerah -> semua desa dalam daerah
                    case 'daerah':

                        $q->orWhere('ms_daerah_id', $akses->scope_id);

                        break;

                    // akses desa -> desa tersebut
                    case 'desa':

                        $q->orWhere('ms_desa_id', $akses->scope_id);

                        break;

                    // akses kelompok -> desa dari kelompok tersebut
                    case 'kelompok':

                        $q->orWhereIn(
                            'ms_desa_id', Kelompok::query()
                            ->where('ms_kelompok_id', $akses->scope_id)
                            ->pluck('ms_desa_id')
                        );

                        break;
                }
            }
        });

        return $query;
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
