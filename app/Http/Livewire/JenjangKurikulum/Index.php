<?php

namespace App\Http\Livewire\JenjangKurikulum;

use App\Models\JenjangKurikulum;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filter
    public $search;
    public $status;

    protected $listeners = [
        'JenjangIndex' => '$refresh',
    ];

    public function updating($property)
    {
        if (!in_array($property, ['page'])) {
            $this->resetPage();
        }
    }

    public function getQueryProperty()
    {
        return JenjangKurikulum::query()

            // SEARCH
            ->when(
                $this->search,
                fn($q) =>
                $q->where('nama_jenjang', 'like', "%{$this->search}%")
            )

            ->latest();
    }


    public function render()
    {
        return view('livewire.jenjang-kurikulum.index',[
            'data' => $this->query->paginate(25)
        ]);
    }
}
