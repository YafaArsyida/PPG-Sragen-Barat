<?php

namespace App\Http\Livewire\TemanPengurus\KegiatanPengurus;

use App\Models\TemanPengurus\KegiatanPengurus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $kegiatanId;

    public $nama_kegiatan = '';

    public $tanggal = '';
    public $waktu = '';
    public $deskripsi = '';

    // custom input
    public $tempat;
    public $alamat;
    public $peta;

    protected $listeners = [
        'KegiatanEdit' => 'loadData'
    ];

    public function loadData($id)
    {
        $kegiatan = KegiatanPengurus::find($id);

        if (!$kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }

        $this->kegiatanId     = $kegiatan->ms_kegiatan_pengurus_id;

        $this->nama_kegiatan  = $kegiatan->nama_kegiatan;

        $this->tempat = $kegiatan->tempat;
        $this->alamat = $kegiatan->alamat;
        $this->peta   = $kegiatan->peta;

        $this->tanggal = $kegiatan->tanggal;
        $this->waktu = $kegiatan->waktu;
        $this->deskripsi = $kegiatan->deskripsi;
    }

    protected function rules()
    {
        $rules = [
            'nama_kegiatan'  => 'required|string|min:3|max:150',

            'waktu'          => 'required|date_format:H:i:s',

            'tempat'         => 'nullable|string|max:150',
            'alamat'         => 'nullable|string|max:255',
            'peta'           => 'nullable|url',

            'deskripsi'      => 'nullable|string|max:500',
        ];

        return $rules;
    }

    protected $messages = [
        'nama_kegiatan.required'  => 'Nama kegiatan wajib diisi.',
        'nama_kegiatan.min'       => 'Nama kegiatan minimal 3 karakter.',
        'nama_kegiatan.max'       => 'Nama kegiatan maksimal 150 karakter.',

        'tanggal.required'       => 'Tanggal wajib diisi untuk kegiatan sekali.',
        'tanggal.date'           => 'Format tanggal tidak valid.',

        'waktu.required'         => 'Waktu kegiatan wajib diisi.',
        'waktu.date_format'      => 'Format waktu harus HH:MM:SS.',

        'tempat.required'        => 'Tempat wajib diisi jika lokasi berbeda.',
        'tempat.max'             => 'Nama tempat maksimal 150 karakter.',

        'alamat.max'             => 'Alamat maksimal 255 karakter.',

        'peta.url'               => 'Format URL peta tidak valid.',

        'deskripsi.max'          => 'Deskripsi maksimal 500 karakter.',
    ];

    public function update()
    {
        $validated = $this->validate();

        DB::beginTransaction();
        try {
            KegiatanPengurus::where('ms_kegiatan_pengurus_id', $this->kegiatanId)->update([
                'nama_kegiatan' => $this->nama_kegiatan,

                'tempat' => $this->tempat,
                'alamat' => $this->alamat,
                'peta'   => $this->peta,

                'tanggal' => $this->tanggal,
                'waktu' => $this->waktu,

                'deskripsi' => $this->deskripsi,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Kegiatan berhasil diperbarui'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'KegiatanEdit'
            ]);

            $this->emit('KegiatanIndex');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.teman-pengurus.kegiatan-pengurus.edit');
    }
}
