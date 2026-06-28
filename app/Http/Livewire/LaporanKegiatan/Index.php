<?php

namespace App\Http\Livewire\LaporanKegiatan;

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
    public $jenjangUsia = null;

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
            ->with(['ms_desa', 'ms_kelompok.ms_desa'])
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
            function ($q) {

                $q->where(function ($qq) {

                    // Kegiatan sekali
                    $qq->whereBetween('tanggal', [
                        $this->startDate,
                        $this->endDate
                    ]);

                    // Kegiatan rutin selalu tampil
                    $qq->orWhere('tipe_kegiatan', 'rutin');

                    // Kegiatan khusus
                    $qq->orWhere(function ($sub) {

                        $sub->where('tipe_kegiatan', 'khusus')
                            ->whereRaw(
                                "
                                EXISTS (
                                    SELECT 1
                                    FROM JSON_TABLE(
                                        jadwal_khusus,
                                        '$[*]'
                                        COLUMNS (
                                            tanggal DATE PATH '$.tanggal'
                                        )
                                    ) jt
                                    WHERE jt.tanggal BETWEEN ? AND ?
                                )
                                ",
                                [$this->startDate, $this->endDate]
                            );
                    });
                });
            }
        );

        // FILTER TIPE KEGIATAN
        $query->when(
            $this->tipeKegiatan,
            fn($q) =>
            $q->where('tipe_kegiatan', $this->tipeKegiatan)
        );
        
        $query->when(
            $this->jenjangUsia,
            fn ($q) => $q->where('jenjang', $this->jenjangUsia)
        );
        // FILTER TAMBAHAN
        if ($this->search) {
            $query->where('nama_kegiatan', 'like', "%{$this->search}%");
        }

       return $query->orderByRaw("
            CASE
                WHEN tipe_kegiatan = 'rutin' THEN 0
                WHEN tipe_kegiatan = 'khusus' THEN 1
                ELSE 2
            END
        ")->latest('created_at');
    }
    public function render()
    {
        return view('livewire.laporan-kegiatan.index',[
            'listKegiatan' => $this->query->paginate(25)
        ]);
    }
}
