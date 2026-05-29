<?php

namespace App\Http\Livewire\PenilaianKurikulum;

use App\Models\AspekKurikulum;
use Livewire\Component;

class Index extends Component
{
    public $selectedPeriode;
    public $selectedJenjang;
    public $selectedKelompok;

    protected $listeners = [
        'parameterKurikulumUpdated',
        'AspekIndex' => '$refresh',
    ];

    public function parameterKurikulumUpdated($params)
    {
        $this->selectedPeriode = $params['periode'] ?? null;

        $this->selectedJenjang = $params['jenjang'] ?? null;
        $this->selectedKelompok = $params['kelompok'] ?? null;
    }

    public function getDataProperty()
    {
        // Guard clause
        if (!$this->selectedPeriode || !$this->selectedJenjang) {
            return collect();
        }

        return AspekKurikulum::query()

            ->withCount('ms_materi_kurikulum')

            ->where('ms_periode_kurikulum_id', $this->selectedPeriode)

            ->where('ms_jenjang_kurikulum_id', $this->selectedJenjang)
            ->orderBy('urutan')
            ->get();
    }

    public function render()
    {
        return view('livewire.penilaian-kurikulum.index');
    }
}
