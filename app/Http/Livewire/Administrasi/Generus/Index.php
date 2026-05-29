<?php

namespace App\Http\Livewire\Administrasi\Generus;

use App\Models\Generus;
use App\Models\Kelompok;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $namaDesa = '';
    public $selectedDesa = null;
    
    public $search = '';
    public $gender = '';
    public $status_generus = 'sambung';
    public $jenjangUsia = '';

    public $activeTab = 'semua';
    
    protected $listeners = [
        'parameterUpdated',
        'GenerusIndex' => '$refresh',
    ];

    public function setActiveTab($tab)
    {
        $this->resetPage();
        $this->activeTab = $tab;
    }

    /**
     * Terima parameter dari @livewire('parameter.desa')
     */
    public function parameterUpdated($desaId)
    {
        $this->selectedDesa = $desaId;
        $this->activeTab = 'semua';
    }

    public function getKelompokProperty()
    {
        if (!$this->selectedDesa) {
            return collect();
        }

        return Kelompok::where('ms_desa_id', $this->selectedDesa)
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function getAllGenerusProperty()
    {
        // Guard clause
        if (!$this->selectedDesa) {
            return Generus::query()->whereRaw('1 = 0');
        }

        $query = Generus::with('ms_kelompok.ms_desa')
            ->whereHas('ms_kelompok', function ($q) {
                $q->where('ms_desa_id', $this->selectedDesa);
            });


        // Search
        if ($this->search) {
            $query->where('nama_generus', 'like', '%' . $this->search . '%');
        }

        // Status
        if ($this->status_generus) {
            $query->where('status_generus', $this->status_generus);
        }

        // Gender
        if ($this->gender) {
            $query->where('jenis_kelamin', $this->gender);
        }

        // Jenjang usia
        if ($this->jenjangUsia) {

            $range = Generus::jenjangUsiaMap()[$this->jenjangUsia] ?? null;

            if ($range) {

                [$min, $max] = $range;

                $startDate = now()->subYears($max)->startOfDay();
                $endDate   = now()->subYears($min)->endOfDay();

                $query->whereBetween('tanggal_lahir', [$startDate, $endDate]);
            }
        }

        // Filter tab kelompok
        if (str_contains($this->activeTab, 'kelompok-')) {
            $kelompokId = str_replace('kelompok-', '', $this->activeTab);

            $query->where('ms_kelompok_id', $kelompokId);
        }

        return $query;
    }

    public function render()
    {
        return view('livewire.administrasi.generus.index', [
            'kelompok'   => $this->kelompok,
            'allGenerus' => $this->allGenerus->paginate(50),
        ]);
    }
}
