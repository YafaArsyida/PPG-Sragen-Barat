<?php

namespace App\Http\Livewire\Monitoring\KegiatanGenerus;

use App\Models\Generus;
use App\Models\KegiatanGenerus;
use App\Models\Kelompok;
use App\Models\PresensiKegiatanGenerus;
use Carbon\Carbon;
use Livewire\Component;

class Statistik extends Component
{
    public $selectedDesa = null;

    public $periodeKehadiran = '1_bulan';
    public $periodeKegiatan = '1_bulan';

    public $selectedKelompok = null;

    protected $listeners = [
        'parameterUpdated',
    ];

    public function parameterUpdated($desaId)
    {
        $this->selectedDesa = $desaId;
        $this->selectedKelompok = null;
    }

    public function getKelompokListProperty()
    {
        if (!$this->selectedDesa) {
            return collect();
        }

        return Kelompok::where('ms_desa_id', $this->selectedDesa)
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function getTotalGenerusProperty()
    {
        return Generus::whereHas('ms_kelompok', function ($query) {

            // Filter Desa
            $query->where('ms_desa_id', $this->selectedDesa);

            // Filter Kelompok
            if ($this->selectedKelompok) {
                $query->where(
                    'ms_kelompok_id',
                    $this->selectedKelompok
                );
            }

        })->count();
    }
    
    public function getTotalKelompokProperty()
    {
        return Kelompok::where('ms_desa_id', $this->selectedDesa)
            ->count();
    }

    public function getTotalKegiatanProperty()
    {
        $tanggalMulai = match ($this->periodeKegiatan) {
            '3_bulan' => now()->subMonths(3)->startOfDay(),
            '1_tahun' => now()->subYear()->startOfDay(),
            default   => now()->subMonth()->startOfDay(),
        };

        $tanggalAkhir = now()->endOfDay();

        return KegiatanGenerus::query()
            ->where('ms_desa_id', $this->selectedDesa)

            // Filter kelompok sebagai master filter
            ->when($this->selectedKelompok, function ($query) {
                $query->where(function ($q) {

                    // Kegiatan khusus kelompok
                    $q->where(function ($sub) {
                        $sub->where('scope', 'kelompok')
                            ->where('ms_kelompok_id', $this->selectedKelompok);
                    })

                    // Kegiatan desa tetap berlaku untuk kelompok tersebut
                    ->orWhere('scope', 'desa');
                });
            })

            // Filter periodeKegiatan
            ->when($tanggalMulai && $tanggalAkhir, function ($query) use ($tanggalMulai, $tanggalAkhir) {

                $query->where(function ($q) use ($tanggalMulai, $tanggalAkhir) {

                    // Kegiatan sekali
                    $q->where(function ($sub) use ($tanggalMulai, $tanggalAkhir) {
                        $sub->where('tipe_kegiatan', 'sekali')
                            ->whereBetween('tanggal', [
                                $tanggalMulai,
                                $tanggalAkhir
                            ]);
                    })

                    // Kegiatan rutin
                    ->orWhere('tipe_kegiatan', 'rutin')

                    // Kegiatan khusus
                    ->orWhere(function ($sub) use ($tanggalMulai, $tanggalAkhir) {
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
                                [$tanggalMulai, $tanggalAkhir]
                            );
                    });
                });
            })

            ->count();
    }

    public function getRataKehadiranProperty()
    {
        $tanggalMulai = match ($this->periodeKehadiran) {
            '3_bulan' => Carbon::now()->subMonths(3)->startOfDay(),
            '1_tahun' => Carbon::now()->subYear()->startOfDay(),
            default   => Carbon::now()->subMonth()->startOfDay(),
        };

        $tanggalAkhir = Carbon::now()->endOfDay();

        // Ambil kegiatan pada desa terpilih
        $kegiatan = KegiatanGenerus::query()
            ->whereBetween('tanggal', [
                $tanggalMulai,
                $tanggalAkhir
            ])
            ->where(function ($query) {
                $query
                    ->where(function ($q) {
                        $q->where('scope', 'desa')
                        ->where('ms_desa_id', $this->selectedDesa);
                    })
                    ->orWhere(function ($q) {
                        $q->where('scope', 'kelompok')
                        ->whereHas('ms_kelompok', function ($q2) {
                            $q2->where('ms_desa_id', $this->selectedDesa);
                        });
                    });
            })
            ->get();

        if ($kegiatan->isEmpty()) {
            return 0;
        }

        $totalTarget = 0;
        $totalHadir = 0;

        foreach ($kegiatan as $item) {

            // Jumlah generus yang seharusnya mengikuti kegiatan
            $target = $item->targetPeserta();

            if ($target <= 0) {
                continue;
            }

            // Jumlah yang benar-benar hadir
            $hadir = $item->totalHadir();

            $totalTarget += $target;
            $totalHadir += $hadir;
        }

        if ($totalTarget <= 0) {
            return 0;
        }

        return round(
            ($totalHadir / $totalTarget) * 100,
            1
        );
    }

    public function render()
    {
        return view('livewire.monitoring.kegiatan-generus.statistik');
    }
}
