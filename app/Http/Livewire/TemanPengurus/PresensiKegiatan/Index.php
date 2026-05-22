<?php

namespace App\Http\Livewire\TemanPengurus\PresensiKegiatan;

use App\Models\TemanPengurus\Dapukan;
use App\Models\TemanPengurus\KegiatanPengurus;
use App\Models\TemanPengurus\Pengurus;
use App\Models\TemanPengurus\PresensiKegiatan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // ================= FILTER PENGURUS (KIRI) =================
    public $searchPengurus = '';
    public $ms_dapukan_id = '';
    public $genderPengurus = '';

    public $jenis_kelamin = '';

    public $token;
    public $kegiatan;

    public $presensiMap = [];   // untuk tombol di tabel Pengurus

    public $listDapukan = [];
    public $listPengurus = [];

    public function refreshPresensi()
    {
        $this->loadPresensiMap();
        $this->loadPengurus(); // optional
    }


    public function mount($token)
    {
        $this->token = $token;

        $this->kegiatan = KegiatanPengurus::where('token', $token)
            ->where('status', 'aktif')
            ->first();

        if (!$this->kegiatan) {
            abort(404);
        }

        $this->loadDapukan();

        $this->loadPengurus();
        $this->loadPresensiMap(); // ⬅️ WAJIB di sini
    }

    protected function loadDapukan()
    {
        $query = Dapukan::query();

        $this->listDapukan = $query
            ->orderBy('nama_dapukan')
            ->get();
    }

    public function loadPengurus()
    {
        $this->listPengurus = Pengurus::with([
            'ms_kelompok.ms_desa',
            'ms_penempatan_dapukan'
        ])

            // SEARCH
            ->when(
                $this->searchPengurus,
                fn($q) =>
                $q->where('nama_pengurus', 'like', "%{$this->searchPengurus}%")
            )

            // FILTER DAPUKAN
            ->when(
                $this->ms_dapukan_id,
                fn($q) =>
                $q->whereHas('ms_penempatan_dapukan', function ($subQuery) {
                    $subQuery->where(
                        'ms_dapukan_id',
                        $this->ms_dapukan_id
                    );
                })
            )

            // FILTER GENDER
            ->when(
                $this->genderPengurus,
                fn($q) =>
                $q->where('jenis_kelamin', $this->genderPengurus)
            )
            ->orderBy('nama_pengurus')
            ->get();
    }

    protected function loadPresensiMap()
    {
        $existing = PresensiKegiatan::where('ms_kegiatan_pengurus_id', $this->kegiatan->ms_kegiatan_pengurus_id)
            ->get()
            ->keyBy('ms_pengurus_id');

        $this->presensiMap = $existing
            ->map(fn($p) => $p->status_hadir)
            ->toArray();
    }

    public function updated($property)
    {
        // filter Pengurus kiri
        if (in_array($property, ['searchPengurus', 'ms_dapukan_id', 'genderPengurus'])) {
            $this->loadPengurus();
            $this->loadPresensiMap();
        }
    }

    public function hadir($pengurusId)
    {
        $presensi = PresensiKegiatan::firstOrCreate(
            [
                'ms_kegiatan_pengurus_id' => $this->kegiatan->ms_kegiatan_pengurus_id,
                'ms_pengurus_id'  => $pengurusId,
                'tanggal_presensi' => today(),
            ],
            [
                'waktu_hadir'  => now(),
                'status_hadir' => 'hadir',
                'verifikasi'   => 'manual',
                'deskripsi'    => null,
            ]
        );

        $this->loadPresensiMap();

        // alertify
        if ($presensi->wasRecentlyCreated) {
            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Pengurus hadir berhasil dicatat'
            ]);
        } else {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Presensi sudah ada, tidak diubah'
            ]);
        }
    }

    public function izin($pengurusId)
    {
        $presensi = PresensiKegiatan::firstOrCreate(
            [
                'ms_kegiatan_pengurus_id' => $this->kegiatan->ms_kegiatan_pengurus_id,
                'ms_pengurus_id'  => $pengurusId,
                'tanggal_presensi' => today(),
            ],
            [
                'waktu_hadir'  => null,
                'status_hadir' => 'izin',
                'verifikasi'   => 'manual',
                'deskripsi'    => 'Izin',
            ]
        );

        $this->loadPresensiMap();

        if ($presensi->wasRecentlyCreated) {
            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Pengurus izin berhasil dicatat'
            ]);
        } else {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Presensi izin sudah ada, tidak diubah'
            ]);
        }
    }

    public function batalPresensi($pengurusId)
    {
        PresensiKegiatan::where('ms_kegiatan_pengurus_id', $this->kegiatan->ms_kegiatan_pengurus_id)
            ->where('ms_Pengurus_id', $pengurusId)
            ->delete();

        $this->loadPresensiMap();

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Presensi berhasil dibatalkan'
        ]);
    }

    public function render()
    {
        return view('livewire.teman-pengurus.presensi-kegiatan.index');
    }
}
