<?php

namespace App\Http\Livewire\Operasional\KegiatanRutin;

use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ms_desa_id = null;
    public $search = '';
    public $ms_kelompok_id;
   
    public $jenjangUsia = '';

    public $listKelompok = [];

    public $hari = '';
    public $status;

    protected $listeners = [
        'KegiatanIndex' => '$refresh',
        'parameterUpdated' => 'setParameterDesa'
    ];

    public function setParameterDesa($desaId)
    {
        $this->ms_desa_id = $desaId;
        $this->ms_kelompok_id = null;
        $this->loadKelompok();
        $this->resetPage();
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

    public function updating($property)
    {
        if ($property !== 'page') {
            $this->resetPage();
        }
    }

    public function getQueryProperty()
    {
        $query = KegiatanGenerus::query()
            ->with(['ms_desa', 'ms_kelompok.ms_desa'])
            ->withSum('tr_infaq', 'nominal')
            ->withCount([
                'presensi_kegiatan_generus as hadir_count' => function ($q) {
                    $q->where('status_hadir', 'hadir');
                },
                'presensi_kegiatan_generus as izin_count' => function ($q) {
                    $q->where('status_hadir', 'izin');
                },
            ])
            ->where('tipe_kegiatan', 'rutin');

        if (!$this->ms_desa_id) {
            return $query->whereRaw('1 = 0');
        }

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
                    $qq->whereHas('ms_kelompok', function ($sub) {
                        $sub->where('ms_desa_id', $this->ms_desa_id);
                    });
                }
            });
        });

        $query->when(
            $this->status,
            fn($q) => $q->where('status', $this->status)
        );

        $query->when(
            $this->search,
            fn($q) => $q->where('nama_kegiatan', 'like', "%{$this->search}%")
        );

        $query->when(
            $this->jenjangUsia,
            fn($q) => $q->where('jenjang', $this->jenjangUsia)
        )

        ->when(
            $this->hari,
            fn($q) =>
            $q->whereJsonContains('hari_rutin', $this->hari)
        );

        return $query ->orderByRaw("
                CASE 
                    WHEN scope = 'kelompok' THEN 0
                    WHEN scope = 'desa' THEN 1
                    ELSE 2
                END,
                tanggal DESC
            ");
    }

    public function render()
    {
        return view('livewire.operasional.kegiatan-rutin.index', [
            'listKegiatan' => $this->query->paginate(25)
        ]);
    }
}
