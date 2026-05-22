<?php

namespace App\Http\Livewire\TemanPengurus\KegiatanPengurus;

use App\Models\TemanPengurus\KegiatanPengurus;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filter
    public $search;

    public $startDate = null;
    public $endDate = null;

    protected $listeners = [
        'KegiatanIndex' => '$refresh',
    ];

    public function mount()
    {
        // Default ke hari ini
        // $this->startDate = now()->format('Y-m-d');
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');
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
        // $this->startDate = now()->format('Y-m-d');
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Memperbarui...']);
    }

    public function getQueryProperty()
    {
        $query = KegiatanPengurus::query()
            ->when(
                $this->startDate && $this->endDate,
                fn($q) =>
                $q->whereBetween('tanggal', [$this->startDate, $this->endDate])
            );

        // FILTER PENCARIAN
        if ($this->search) {
            $query->where('nama_kegiatan', 'like', "%{$this->search}%");
        }

        return $query->orderBy('tanggal', 'asc');
    }

    public function render()
    {
        return view('livewire.teman-pengurus.kegiatan-pengurus.index', [
            'listKegiatan' => $this->query->paginate(100)
        ]);
    }
}
