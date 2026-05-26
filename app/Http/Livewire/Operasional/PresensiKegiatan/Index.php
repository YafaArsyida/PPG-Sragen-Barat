<?php

namespace App\Http\Livewire\Operasional\PresensiKegiatan;

use App\Models\Generus;
use App\Models\Kegiatan;
use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use App\Models\PresensiKegiatan;
use App\Models\PresensiKegiatanGenerus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedDesa = null;

    public $searchGenerus = '';
    public $kelompokGenerus = '';
    public $genderGenerus = '';

    public $jenjangUsia = '';

    public $token;
    public $kegiatan;

    public $presensiMap = [];

    public $listKelompok = [];

    protected $listeners = [
        'parameterUpdated' => 'setParameterDesa'
    ];

    public function setParameterDesa($desaId)
    {
        $this->selectedDesa = $desaId;

        // reset filter
        $this->kelompokGenerus = null;

        // reset pagination
        $this->resetPage();

        // reload dropdown kelompok
        $this->loadKelompok();
    }

    public function mount($token)
    {
        $this->token = $token;

        $this->kegiatan = KegiatanGenerus::with([
            'ms_desa',
            'ms_kelompok'
        ])
            ->where('token', $token)
            ->where('status', 'aktif')
            ->firstOrFail();

        $this->jenjangUsia = $this->kegiatan->jenjang;

        $this->loadKelompok();

        $this->loadPresensiMap();
    }

    protected function loadKelompok()
    {
        $query = Kelompok::query();

        // SCOPE DAERAH → pakai parameter desa
        if ($this->kegiatan->scope === 'daerah' && $this->selectedDesa) {
            $query->where('ms_desa_id', $this->selectedDesa);
        }

        // SCOPE DESA
        if ($this->kegiatan->scope === 'desa') {
            $query->where('ms_desa_id', $this->kegiatan->ms_desa_id);
        }

        // SCOPE KELOMPOK
        if ($this->kegiatan->scope === 'kelompok') {
            $query->where('ms_kelompok_id', $this->kegiatan->ms_kelompok_id);
        }

        $this->listKelompok = $query
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function getListGenerusProperty()
    {
        return Generus::with(['ms_kelompok.ms_desa'])

            ->when(
                $this->searchGenerus,
                fn($q) =>
                $q->where('nama_generus', 'like', "%{$this->searchGenerus}%")
            )

            ->when(
                $this->kelompokGenerus,
                fn($q) =>
                $q->where('ms_kelompok_id', $this->kelompokGenerus)
            )

            ->when(
                $this->genderGenerus,
                fn($q) =>
                $q->where('jenis_kelamin', $this->genderGenerus)
            )

            // scope daerah
            ->when(
                $this->kegiatan->scope === 'daerah' && $this->selectedDesa,
                fn($q) =>
                $q->whereHas(
                    'ms_kelompok',
                    fn($k) =>
                    $k->where('ms_desa_id', $this->selectedDesa)
                )
            )

            // scope desa
            ->when(
                $this->kegiatan->scope === 'desa',
                fn($q) =>
                $q->whereHas(
                    'ms_kelompok',
                    fn($k) =>
                    $k->where('ms_desa_id', $this->kegiatan->ms_desa_id)
                )
            )

            // scope kelompok
            ->when(
                $this->kegiatan->scope === 'kelompok',
                fn($q) =>
                $q->where('ms_kelompok_id', $this->kegiatan->ms_kelompok_id)
            )

            // jenjang
            ->when($this->kegiatan->jenjang, function ($q) {

                $jenjang = $this->kegiatan->jenjang;

                if (!isset(Generus::jenjangUsiaMap()[$jenjang])) {
                    return;
                }

                [$min, $max] = Generus::jenjangUsiaMap()[$jenjang];

                $q->whereRaw(
                    "TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?",
                    [$min, $max]
                );
            })

            ->orderBy('nama_generus')

            ->paginate(50);
    }

    protected function loadPresensiMap()
    {
        $this->presensiMap = PresensiKegiatanGenerus::where(
            'ms_kegiatan_generus_id',
            $this->kegiatan->ms_kegiatan_generus_id
        )
            ->pluck('status_hadir', 'ms_generus_id')
            ->toArray();
    }

    public function updatedSearchGenerus()
    {
        $this->resetPage();
    }

    public function updatedKelompokGenerus()
    {
        $this->resetPage();
    }

    public function updatedGenderGenerus()
    {
        $this->resetPage();
    }

    public function hadir($generusId)
    {
        $presensi = PresensiKegiatanGenerus::firstOrCreate(
            [
                'ms_kegiatan_generus_id' => $this->kegiatan->ms_kegiatan_generus_id,
                'ms_generus_id' => $generusId,
                'tanggal_presensi' => today(),
            ],
            [
                'waktu_hadir' => now(),
                'status_hadir' => 'hadir',
                'verifikasi' => 'manual',
            ]
        );

        if ($presensi->wasRecentlyCreated) {

            // OPTIMISTIC UPDATE
            $this->presensiMap[$generusId] = 'hadir';

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Generus hadir berhasil dicatat'
            ]);
        } else {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Presensi sudah ada'
            ]);
        }
    }

    public function izin($generusId)
    {
        $presensi = PresensiKegiatanGenerus::firstOrCreate(
            [
                'ms_kegiatan_generus_id' => $this->kegiatan->ms_kegiatan_generus_id,
                'ms_generus_id' => $generusId,
                'tanggal_presensi' => today(),
            ],
            [
                'status_hadir' => 'izin',
                'verifikasi' => 'manual',
                'deskripsi' => 'Izin',
            ]
        );

        if ($presensi->wasRecentlyCreated) {

            $this->presensiMap[$generusId] = 'izin';

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Generus izin berhasil dicatat'
            ]);
        }
    }

    public function batalPresensi($generusId)
    {
        PresensiKegiatanGenerus::where(
            'ms_kegiatan_generus_id',
            $this->kegiatan->ms_kegiatan_generus_id
        )
            ->where('ms_generus_id', $generusId)
            ->delete();

        unset($this->presensiMap[$generusId]);

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Presensi berhasil dibatalkan'
        ]);
    }

    public function render()
    {
        return view('livewire.operasional.presensi-kegiatan.index');
    }
}
