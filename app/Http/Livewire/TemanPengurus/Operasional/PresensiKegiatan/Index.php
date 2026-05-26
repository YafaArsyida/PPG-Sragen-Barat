<?php

namespace App\Http\Livewire\TemanPengurus\Operasional\PresensiKegiatan;

use App\Models\TemanPengurus\Dapukan;
use App\Models\TemanPengurus\KegiatanPengurus;
use App\Models\TemanPengurus\Pengurus;
use App\Models\TemanPengurus\PresensiKegiatanPengurus;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchPengurus = '';
    public $ms_dapukan_id = '';
    public $genderPengurus = '';

    public $token;
    public $kegiatan;

    public $presensiMap = [];

    public $listDapukan = [];

    public function refreshPresensi()
    {
        $this->loadPresensiMap();
    }

    public function mount($token)
    {
        $this->token = $token;

        $this->kegiatan = KegiatanPengurus::where('token', $token)
            ->where('status', 'aktif')
            ->firstOrFail();

        $this->loadDapukan();

        $this->loadPresensiMap();
    }
    protected function loadDapukan()
    {
        $this->listDapukan = Dapukan::query()
            ->orderBy('nama_dapukan')
            ->get();
    }

    public function getListPengurusProperty()
    {
        return Pengurus::with([
            'ms_kelompok.ms_desa',
            'ms_penempatan_dapukan'
        ])
            // SEARCH
            ->when($this->searchPengurus, fn($q) =>
                $q->where(
                    'nama_pengurus',
                    'like',
                    "%{$this->searchPengurus}%"
                )
            )

            // FILTER DAPUKAN
            ->when($this->ms_dapukan_id, fn($q) =>
                $q->whereHas(
                    'ms_penempatan_dapukan',
                    fn($subQuery) =>
                    $subQuery->where(
                        'ms_dapukan_id',
                        $this->ms_dapukan_id
                    )
                )
            )

            // FILTER GENDER
            ->when($this->genderPengurus, fn($q) =>
                $q->where(
                    'jenis_kelamin',
                    $this->genderPengurus
                )
            )

            ->orderBy('nama_pengurus')
            ->paginate(25);
    }

    protected function loadPresensiMap()
    {
        $this->presensiMap =
            PresensiKegiatanPengurus::where(
                'ms_kegiatan_pengurus_id',
                $this->kegiatan->ms_kegiatan_pengurus_id
            )
            ->pluck('status_hadir', 'ms_pengurus_id')
            ->toArray();
    }

    public function updatedSearchPengurus()
    {
        $this->resetPage();
    }

    public function updatedMsDapukanId()
    {
        $this->resetPage();
    }

    public function updatedGenderPengurus()
    {
        $this->resetPage();
    }

    public function hadir($pengurusId)
    {
        $presensi = PresensiKegiatanPengurus::firstOrCreate(
            [
                'ms_kegiatan_pengurus_id' =>
                $this->kegiatan->ms_kegiatan_pengurus_id,

                'ms_pengurus_id' => $pengurusId,

                'tanggal_presensi' => today(),
            ],
            [
                'waktu_hadir' => now(),
                'status_hadir' => 'hadir',
                'verifikasi' => 'manual',
                'deskripsi' => null,
            ]
        );

        if ($presensi->wasRecentlyCreated) {

            // OPTIMISTIC UPDATE
            $this->presensiMap[$pengurusId] = 'hadir';

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Pengurus hadir berhasil dicatat'
            ]);
        } else {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Presensi sudah ada'
            ]);
        }
    }

    public function izin($pengurusId)
    {
        $presensi = PresensiKegiatanPengurus::firstOrCreate(
            [
                'ms_kegiatan_pengurus_id' =>
                $this->kegiatan->ms_kegiatan_pengurus_id,

                'ms_pengurus_id' => $pengurusId,

                'tanggal_presensi' => today(),
            ],
            [
                'waktu_hadir' => null,
                'status_hadir' => 'izin',
                'verifikasi' => 'manual',
                'deskripsi' => 'Izin',
            ]
        );

        if ($presensi->wasRecentlyCreated) {

            $this->presensiMap[$pengurusId] = 'izin';

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Pengurus izin berhasil dicatat'
            ]);
        } else {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Presensi izin sudah ada'
            ]);
        }
    }

    public function batalPresensi($pengurusId)
    {
        PresensiKegiatanPengurus::where(
            'ms_kegiatan_pengurus_id',
            $this->kegiatan->ms_kegiatan_pengurus_id
        )
            ->where('ms_pengurus_id', $pengurusId)
            ->delete();

        // OPTIMISTIC UPDATE
        unset($this->presensiMap[$pengurusId]);

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Presensi berhasil dibatalkan'
        ]);
    }

    public function render()
    {
        return view('livewire.teman-pengurus.operasional.presensi-kegiatan.index');
    }
}
