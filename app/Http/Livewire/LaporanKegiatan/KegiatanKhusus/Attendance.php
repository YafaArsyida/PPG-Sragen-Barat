<?php

namespace App\Http\Livewire\LaporanKegiatan\KegiatanKhusus;

use App\Models\Kelompok;
use App\Models\KegiatanGenerus;
use App\Models\PresensiKegiatanGenerus;
use Livewire\Component;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Attendance extends Component
{
    public $ms_kegiatan_generus_id;
    public $ms_desa_id;
    public $ms_kelompok_id = null;

    public $search = '';
    public $gender = '';

    public $tanggalMatrix = [];
    public $listKelompok = [];

    public $kegiatan;

    protected $listeners = [
        'setKegiatan' => 'setKegiatan',
    ];

    public function mount($kegiatanId = null)
    {
        $this->ms_kegiatan_generus_id = $kegiatanId;
       
        if ($kegiatanId) {
            $this->kegiatan = KegiatanGenerus::find($kegiatanId);
        }

        $this->loadTanggalMatrix();
    }

    public function setKegiatan($kegiatanId)
    {
        $this->ms_kegiatan_generus_id = $kegiatanId;
        $this->kegiatan = KegiatanGenerus::find($kegiatanId);

        $this->ms_desa_id = $this->kegiatan?->ms_desa_id;

        $this->ms_kelompok_id = null;
        $this->search = '';
        $this->gender = '';

        $this->listKelompok = Kelompok::where('ms_desa_id', $this->ms_desa_id)
            ->orderBy('nama_kelompok')
            ->get();
        
        $this->loadTanggalMatrix();
    }

    private function loadTanggalMatrix()
    {
        $this->tanggalMatrix = [];

        if (!$this->kegiatan) {
            return;
        }

        $this->tanggalMatrix = collect($this->kegiatan->jadwal_khusus ?? [])
            ->pluck('tanggal')
            ->sort()
            ->values()
            ->toArray();
    }

    public function getGenerusProperty()
    {
        if (!$this->kegiatan) {
            return collect();
        }

        $query = $this->kegiatan->targetPesertaQuery()
            ->with('ms_kelompok');

        if ($this->ms_kelompok_id) {
            $query->where('ms_kelompok_id', $this->ms_kelompok_id);
        }

        if ($this->search) {
            $query->where('nama_generus', 'like', "%{$this->search}%");
        }

        if ($this->gender) {
            $query->where('jenis_kelamin', $this->gender);
        }

        return $query->orderBy('nama_generus')->get();
    }

    public function getPresensiMapProperty()
    {
        if (!$this->ms_kegiatan_generus_id) {
            return collect();
        }

        return PresensiKegiatanGenerus::query()
            ->where('ms_kegiatan_generus_id',$this->ms_kegiatan_generus_id)
            ->get()
            ->keyBy(function($item){

                return
                    $item->ms_generus_id
                    .'_'.
                    Carbon::parse($item->tanggal_presensi)
                        ->format('Y-m-d');

            });
    }

    public function status($generusId,$tanggal)
    {
        $key = $generusId.'_'.$tanggal;

        return $this->presensiMap[$key]->status_hadir
                ?? 'alfa';
    }

    public function totalGenerus($generusId)
    {
        $totals = [
            'hadir' => 0,
            'izin' => 0,
            'alfa' => 0,
        ];

        foreach ($this->tanggalMatrix as $tanggal) {
            $status = $this->status(
                $generusId,
                $tanggal
            );
            
            if ($status === 'hadir') {
                $totals['hadir']++;
            } elseif ($status === 'izin') {
                $totals['izin']++;
            } else {
                $totals['alfa']++;
            }
        }

        return $totals;
    }
    
    public function render()
    {
        return view('livewire.laporan-kegiatan.kegiatan-khusus.attendance', [
            'generusList' => $this->generus,
            'tanggalMatrix' => $this->tanggalMatrix,
            'listKelompok' => $this->listKelompok,
        ]);
    }
}
