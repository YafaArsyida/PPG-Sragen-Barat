<?php

namespace App\Http\Livewire\Operasional\KegiatanEvent;

use App\Models\KegiatanGenerus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Status extends Component
{
    public $kegiatanId = null;
    public $status = null;
    public $namaKegiatan = null;

    protected $listeners = [
        'KegiatanStatus'
    ];

    public function KegiatanStatus($kegiatanId)
    {
        $kegiatan = KegiatanGenerus::find($kegiatanId);

        if (!$kegiatan) return;

        $this->kegiatanId = $kegiatan->ms_kegiatan_generus_id;
        $this->status = $kegiatan->status;
        $this->namaKegiatan = $kegiatan->nama_kegiatan;
    }

    public function updateStatus()
    {
        if (!$this->kegiatanId) return;

        DB::beginTransaction();

        try {

            $kegiatan = KegiatanGenerus::where(
                'ms_kegiatan_generus_id',
                $this->kegiatanId
            )
                ->lockForUpdate()
                ->first();

            if (!$kegiatan) {

                DB::rollBack();

                $this->dispatchBrowserEvent('alertify-error', [
                    'message' => 'Data kegiatan tidak ditemukan'
                ]);

                return;
            }

            $newStatus = $kegiatan->status === 'aktif'
                ? 'selesai'
                : 'aktif';

            $kegiatan->update([
                'status' => $newStatus
            ]);

            DB::commit();

            // CLOSE MODAL
            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'KegiatanStatus'
            ]);

            // REFRESH
            $this->emit('KegiatanIndex');

            // ALERT
            $this->dispatchBrowserEvent('alertify-success', [
                'message' => $newStatus === 'aktif'
                    ? 'Kegiatan berhasil diaktifkan'
                    : 'Kegiatan berhasil diselesaikan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.operasional.kegiatan-event.status');
    }
}
