<?php

namespace App\Http\Livewire\Operasional\KegiatanGenerus;

use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Parameter Desa dari komponen parameter.desa
    public $ms_desa_id = null;

    // Filter
    public $search;
    public $status;
    public $scope;
    public $tipeKegiatan = ''; // rutin | sekali

    public $ms_kelompok_id;
    public $jenjangUsia = '';

    public $startDate = null;
    public $endDate = null;

    public $listKelompok = [];

    protected $listeners = [
        'KegiatanIndex' => '$refresh',
        'parameterUpdated' => 'setParameterDesa'
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

    public function setParameterDesa($desaId)
    {
        $this->ms_desa_id = $desaId;
        $this->ms_kelompok_id = null;
        $this->loadKelompok();
    }

    public function loadKelompok()
    {
        if (!$this->ms_desa_id) {
            $this->listKelompok = [];
            return;
        }

        $this->listKelompok = Kelompok::where('ms_desa_id', $this->ms_desa_id)
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function resetTanggal()
    {
        // $this->startDate = now()->format('Y-m-d');
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');

        $this->loadKelompok();
        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Memperbarui...']);
    }

    public function getQueryProperty()
    {
        $query = KegiatanGenerus::query()
            ->with([
                'ms_desa',
                'ms_kelompok.ms_desa'
            ])
            ->withSum('tr_infaq', 'nominal')
            ->withCount([
                'presensi_kegiatan_generus as hadir_count' => function ($q) {
                    $q->where('status_hadir', 'hadir');
                },

                'presensi_kegiatan_generus as izin_count' => function ($q) {
                    $q->where('status_hadir', 'izin');
                },
            ]);

        // Guard clause
        if (!$this->ms_desa_id) {
            return $query->whereRaw('1 = 0');
        }

        // VISIBILITY RULE
        $query->where(function ($q) {

            $q->where('scope', 'daerah');

            $q->orWhere(function ($qq) {
                $qq->where('scope', 'desa')
                    ->where('ms_desa_id', $this->ms_desa_id);
            });

            $q->orWhere(function ($qq) {

                $qq->where('scope', 'kelompok');

                if ($this->ms_kelompok_id) {

                    $qq->where('ms_kelompok_id', $this->ms_kelompok_id);
                } else {

                    $qq->whereIn('ms_kelompok_id', function ($sub) {
                        $sub->select('ms_kelompok_id')
                            ->from('ms_kelompok')
                            ->where('ms_desa_id', $this->ms_desa_id);
                    });
                }
            });
        });

        // FILTER TANGGAL
        $query->when(
            $this->startDate && $this->endDate,
            fn($q) =>
            $q->whereBetween('tanggal', [
                $this->startDate,
                $this->endDate
            ])
        );

        // FILTER TIPE KEGIATAN
        $query->when(
            $this->tipeKegiatan,
            fn($q) =>
            $q->where('tipe_kegiatan', $this->tipeKegiatan)
        );

        // FILTER SEARCH
        $query->when(
            $this->search,
            fn($q) =>
            $q->where('nama_kegiatan', 'like', "%{$this->search}%")
        );

        return $query->orderByRaw("
        CASE 
            WHEN tipe_kegiatan = 'rutin' THEN 0 
            ELSE 1 
        END,
        tanggal ASC
    ");
    }
    public function render()
    {
        return view('livewire.operasional.kegiatan-generus.index',[
            'listKegiatan' => $this->query->paginate(25)
        ]);
    }
}
