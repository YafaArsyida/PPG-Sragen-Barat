<?php

namespace App\Http\Livewire\Infaq;

use App\Models\Kegiatan;
use App\Models\KegiatanGenerus;
use App\Models\TRInfaq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $ms_kegiatan_generus_id;
    public $nama_kegiatan;
    public $tanggal_kegiatan;
    public $nominal;
    public $tanggal;
    public $keterangan;

    public $listInfaq = [];

    protected $listeners = ['InfaqCreate'];

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
    }

    public function InfaqCreate($ms_kegiatan_generus_id)
    {
        $this->resetInput();

        $kegiatan = KegiatanGenerus::findOrFail($ms_kegiatan_generus_id);

        $this->ms_kegiatan_generus_id = $kegiatan->ms_kegiatan_generus_id;
        $this->nama_kegiatan  = $kegiatan->nama_kegiatan;
        $this->tanggal_kegiatan  = $kegiatan->tanggal;

        $this->tanggal = now()->format('Y-m-d');

        $this->listInfaq = TRInfaq::with('ms_pengguna')
            ->where('ms_kegiatan_generus_id', $ms_kegiatan_generus_id)
            ->latest()
            ->get();

        $this->emitSelf('render');
    }

    protected $rules = [
        'ms_kegiatan_generus_id' => 'required|exists:ms_kegiatan_generus,ms_kegiatan_generus_id',
        'nominal'        => 'required|numeric|min:1000',
        'tanggal'        => 'required|date',
        'keterangan'     => 'nullable|string|max:500',
    ];

    protected $messages = [

        'nominal.required' => 'Nominal infaq wajib diisi.',
        'nominal.numeric'  => 'Nominal harus berupa angka.',
        'nominal.min'      => 'Minimal infaq Rp 1.000.',

        'tanggal.required' => 'Tanggal wajib diisi.',
        'tanggal.date'     => 'Format tanggal tidak valid.',

        'keterangan.max'   => 'Keterangan maksimal 500 karakter.',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();

        DB::beginTransaction();

        try {

            TRInfaq::create([
                'ms_kegiatan_generus_id' => $this->ms_kegiatan_generus_id,
                'ms_pengguna_id' => Auth::id(),
                'nominal'        => $this->nominal,
                'tanggal'        => $this->tanggal,
                'keterangan'     => $this->keterangan,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Berhasil menambahkan infaq!'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'ModalInfaqCreate'
            ]);

            $this->emit('KegiatanIndex');

            $this->resetInput();
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ]);
        }
    }

    public function resetInput()
    {
        $this->ms_kegiatan_generus_id = '';
        $this->nama_kegiatan  = '';
        $this->nominal        = '';
        $this->tanggal        = now()->format('Y-m-d');
        $this->keterangan     = '';
    }
    public function render()
    {
        return view('livewire.infaq.create');
    }
}
