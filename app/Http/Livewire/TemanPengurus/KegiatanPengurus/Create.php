<?php

namespace App\Http\Livewire\TemanPengurus\KegiatanPengurus;

use App\Models\TemanPengurus\KegiatanPengurus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $nama_kegiatan = '';

    public $tanggal = '';
    public $waktu = '';
    public $deskripsi = '';

    // custom input
    public $tempat;
    public $alamat;
    public $peta;

    protected $listeners = [
        'KegiatanCreate' => 'initCreate'
    ];

    public function initCreate()
    {
        $this->resetInput();
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

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $validated = $this->validate();

        DB::beginTransaction();
        try {
            KegiatanPengurus::create([
                'nama_kegiatan' => $this->nama_kegiatan,

                'tempat' => $this->tempat,
                'alamat' => $this->alamat,
                'peta'   => $this->peta,

                'tanggal' => $this->tanggal,
                'waktu' => $this->waktu,

                'status' => 'aktif',
                'deskripsi' => $this->deskripsi,

            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Berhasil menambahkan kegiatan!'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'KegiatanCreate'
            ]);

            $this->emit('KegiatanIndex');
            $this->resetInput();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function resetInput()
    {
        $this->nama_kegiatan = '';

        $this->tanggal = '';
        $this->waktu = '';

        $this->deskripsi = '';

        // lokasi
        $this->tempat = null;
        $this->alamat = null;
        $this->peta = null;

        // clear error bag
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.teman-pengurus.kegiatan-pengurus.create');
    }
}
