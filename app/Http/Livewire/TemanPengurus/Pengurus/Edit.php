<?php

namespace App\Http\Livewire\TemanPengurus\Pengurus;

use App\Models\Desa;
use App\Models\Kelompok;
use App\Models\TemanPengurus\Pengurus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $ms_pengurus_id;

    public $ms_desa_id;
    public $ms_kelompok_id;

    public $nama_pengurus;
    public $kode_pengurus;
    public $telepon;

    public $tempat_lahir;
    public $tanggal_lahir;

    public $jenis_kelamin;

    public $alamat;
    public $deskripsi;

    public $listDesa = [];
    public $listKelompok = [];

    protected $listeners = [
        'PengurusEdit',
    ];

    public function mount()
    {
        $this->loadDesa();
    }

    public function loadDesa()
    {
        $this->listDesa = Desa::orderBy('nama_desa')->get();
    }

    public function updatedMsDesaId($value)
    {
        $this->ms_kelompok_id = '';

        $this->listKelompok = Kelompok::where('ms_desa_id',$value)
            ->orderBy('nama_kelompok')
            ->get();
    }

    public function PengurusEdit($id)
    {
        $this->resetValidation();

        $pengurus = Pengurus::with('ms_kelompok')->findOrFail($id);

        $this->ms_pengurus_id = $pengurus->ms_pengurus_id;

        $this->ms_kelompok_id = $pengurus->ms_kelompok_id;

        $this->ms_desa_id = optional($pengurus->ms_kelompok)->ms_desa_id;

        $this->listKelompok = Kelompok::where('ms_desa_id', $this->ms_desa_id)
            ->orderBy('nama_kelompok')
            ->get();

        $this->nama_pengurus = $pengurus->nama_pengurus;
        $this->kode_pengurus = $pengurus->kode_pengurus;
        $this->telepon = $pengurus->telepon;
        $this->tempat_lahir = $pengurus->tempat_lahir;
        $this->tanggal_lahir = $pengurus->tanggal_lahir;
        $this->jenis_kelamin = $pengurus->jenis_kelamin;
        $this->alamat = $pengurus->alamat;
        $this->deskripsi = $pengurus->deskripsi;
    }

    protected function rules()
    {
        return [
            'ms_desa_id' => 'required',
            // 'ms_kelompok_id' => 'required',
            'nama_pengurus' => 'required|string|max:150',
            'kode_pengurus' => 'nullable|string|max:50|unique:ms_pengurus,kode_pengurus,' . $this->ms_pengurus_id . ',ms_pengurus_id',
            'telepon' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ];
    }

    protected $messages = [
        'ms_desa_id.required' => 'Desa wajib dipilih',
        // 'ms_kelompok_id.required' => 'Kelompok wajib dipilih',
        'nama_pengurus.required' => 'Nama pengurus wajib diisi',
        'kode_pengurus.unique' => 'Kode pengurus sudah digunakan',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function update()
    {
        $validated = $this->validate();

        DB::beginTransaction();
        try {
            $pengurus = Pengurus::findOrFail(
                $this->ms_pengurus_id
            );
            $pengurus->update([
                'ms_kelompok_id' => $this->ms_kelompok_id,
                'nama_pengurus' => $this->nama_pengurus,
                'kode_pengurus' => $this->kode_pengurus,
                'telepon' => $this->telepon,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'deskripsi' => $this->deskripsi,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Berhasil update pengurus'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'PengurusEdit'
            ]);

            $this->emit('PengurusIndex');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.teman-pengurus.pengurus.edit');
    }
}
