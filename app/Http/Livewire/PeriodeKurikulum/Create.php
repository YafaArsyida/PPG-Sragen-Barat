<?php

namespace App\Http\Livewire\PeriodeKurikulum;

use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $nama_periode;
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $deskripsi;

    protected $listeners = [
        'PeriodeCreate',
    ];

    public function PeriodeCreate()
    {
        $this->resetInput();
        $this->emitSelf('render');
    }

    protected function rules()
    {
        return [
            'nama_periode'   => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',

            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai'
            ],

            'deskripsi'   => 'nullable|string',

        ];
    }

    protected $messages = [
        'nama_periode.required' => 'Nama periode wajib diisi',

        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
        'tanggal_mulai.date' => 'Format tanggal mulai tidak valid',

        'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
        'tanggal_selesai.date' => 'Format tanggal selesai tidak valid',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah tanggal mulai',
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

            PeriodeKurikulum::create([
                'nama_periode'    => $validatedData['nama_periode'],
                'tanggal_mulai'   => $validatedData['tanggal_mulai'],
                'tanggal_selesai' => $validatedData['tanggal_selesai'],
                'deskripsi' => $validatedData['deskripsi'],
                'status'          => 'aktif',
            ]);


            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Berhasil menambah periode!']);
            $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'PeriodeCreate']);
            $this->emit('PeriodeIndex');
            $this->resetInput();
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function resetInput()
    {
        $this->nama_periode = '';
        $this->deskripsi = '';
    }
    
    public function render()
    {
        return view('livewire.periode-kurikulum.create');
    }
}
