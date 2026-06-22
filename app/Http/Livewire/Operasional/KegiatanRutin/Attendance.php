<?php

namespace App\Http\Livewire\Operasional\KegiatanRutin;

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

    public $startDate;
    public $endDate;

    public $tanggalMatrix = [];
    public $listKelompok = [];

    public $kegiatan;

    protected $listeners = [
        'setKegiatan' => 'setKegiatan',
    ];

    public function mount($kegiatanId = null)
    {
        $this->ms_kegiatan_generus_id = $kegiatanId;
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');

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

        $this->resetTanggal();
    }

    public function updatedStartDate()
    {
        $this->loadTanggalMatrix();
    }

    public function updatedEndDate()
    {
        $this->loadTanggalMatrix();
    }

    public function resetTanggal()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
        $this->loadTanggalMatrix();
    }

    public function loadTanggalMatrix()
    {
        $this->tanggalMatrix = [];

        if (!$this->kegiatan || !$this->startDate || !$this->endDate) {
            return;
        }

        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        if ($end->lt($start)) {
            return;
        }

        if ($this->kegiatan->tipe_kegiatan === 'rutin') {
            $hariRutin = $this->kegiatan->hari_rutin ?? [];
            $period = CarbonPeriod::create($start, $end);

            foreach ($period as $tanggal) {
                $hari = strtolower($tanggal->locale('id')->dayName);

                if (in_array($hari, $hariRutin)) {
                    $this->tanggalMatrix[] = $tanggal->format('Y-m-d');
                }
            }
        } else {
            if ($this->kegiatan->tanggal) {
                $eventDate = Carbon::parse($this->kegiatan->tanggal)->format('Y-m-d');

                if (Carbon::parse($eventDate)->between($start, $end)) {
                    $this->tanggalMatrix[] = $eventDate;
                }
            }
        }
        // compute per-date percentages after tanggalMatrix is ready
        $this->computeDailyPercentages();
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

        return PresensiKegiatanGenerus::where('ms_kegiatan_generus_id', $this->ms_kegiatan_generus_id)
            ->whereBetween('tanggal_presensi', [$this->startDate, $this->endDate])
            ->get()
            ->keyBy(function ($item) {
                return $item->ms_generus_id . '_' . $item->tanggal_presensi;
            });
    }

    public function status($generusId, $tanggal)
    {
        $key = $generusId . '_' . $tanggal;

        if (!isset($this->presensiMap[$key])) {
            return 'alfa';
        }

        return $this->presensiMap[$key]->status_hadir;
    }

    public function totalGenerus($generusId)
    {
        $totals = [
            'hadir' => 0,
            'izin' => 0,
            'alfa' => 0,
        ];

        foreach ($this->tanggalMatrix as $tgl) {
            $status = $this->status($generusId, $tgl);

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
        return view('livewire.operasional.kegiatan-rutin.attendance', [
            'generusList' => $this->generus,
            'tanggalMatrix' => $this->tanggalMatrix,
            'listKelompok' => $this->listKelompok,
        ]);
    }
    
    protected function computeDailyPercentages()
    {
        $stats = [];

        if (!$this->kegiatan) {
            $this->emit('attendancePeriodStats', [
                'start' => $this->startDate,
                'end' => $this->endDate,
                'stats' => $stats,
            ]);
            return;
        }

        $targetQuery = $this->kegiatan->targetPesertaQuery();

        if ($this->ms_desa_id) {
            $targetQuery->whereHas('ms_kelompok', function ($q) {
                $q->where('ms_desa_id', $this->ms_desa_id);
            });
        }

        if ($this->ms_kelompok_id) {
            $targetQuery->where('ms_kelompok_id', $this->ms_kelompok_id);
        }

        $targetTotal = $targetQuery->count();

        foreach ($this->tanggalMatrix as $date) {
            $hadir = PresensiKegiatanGenerus::where('ms_kegiatan_generus_id', $this->ms_kegiatan_generus_id)
                ->where('tanggal_presensi', $date)
                ->where('status_hadir', 'hadir')
                ->when($this->ms_desa_id, function ($q) {
                    $q->whereHas('ms_generus.ms_kelompok', function ($qq) {
                        $qq->where('ms_desa_id', $this->ms_desa_id);
                    });
                })
                ->when($this->ms_kelompok_id, function ($q) {
                    $q->whereHas('ms_generus', function ($qq) {
                        $qq->where('ms_kelompok_id', $this->ms_kelompok_id);
                    });
                })
                ->count();

            $percent = $targetTotal > 0 ? round(($hadir / $targetTotal) * 100, 1) : 0;

            $stats[$date] = [
                'date' => $date,
                'target' => $targetTotal,
                'hadir' => $hadir,
                'percent' => $percent,
            ];
        }

        $this->emit('attendancePeriodStats', [
            'start' => $this->startDate,
            'end' => $this->endDate,
            'stats' => $stats,
        ]);
    }

}
