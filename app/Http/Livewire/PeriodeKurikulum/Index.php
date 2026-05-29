<?php

namespace App\Http\Livewire\PeriodeKurikulum;

use App\Models\PeriodeKurikulum;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filter
    public $search;
    public $status;

    public $startDate = null;
    public $endDate = null;

    protected $listeners = [
        'PeriodeIndex' => '$refresh',
    ];

    public function mount()
    {
        // Default filter 1 tahun berjalan
        $this->startDate = now()->startOfYear()->format('Y-m-d');
        $this->endDate = now()->endOfYear()->format('Y-m-d');
    }


    public function updatedStartDate()
    {
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode mulai diperbarui'
        ]);
    }

    public function updatedEndDate()
    {
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode selesai diperbarui'
        ]);
    }


    public function updating($property)
    {
        if (!in_array($property, ['page'])) {
            $this->resetPage();
        }
    }

    public function resetTanggal()
    {
        $this->startDate = now()->startOfYear()->format('Y-m-d');
        $this->endDate = now()->endOfYear()->format('Y-m-d');

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Memperbarui...'
        ]);
    }

    public function getQueryProperty()
    {
        return PeriodeKurikulum::query()

            // FILTER RANGE TANGGAL
            ->when(
                $this->startDate && $this->endDate,
                function ($q) {
                    $q->whereDate('tanggal_mulai', '>=', $this->startDate)
                        ->whereDate('tanggal_selesai', '<=', $this->endDate);
                }
            )

            // SEARCH
            ->when(
                $this->search,
                fn($q) =>
                $q->where('nama_periode', 'like', "%{$this->search}%")
            )

            ->latest();
    }

    public function render()
    {
        return view('livewire.periode-kurikulum.index', [
            'data' => $this->query->paginate(25)
        ]);
    }
}
