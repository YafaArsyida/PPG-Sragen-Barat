<?php

namespace App\Http\Livewire\JenjangKurikulum;

use App\Models\JenjangKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $nama_jenjang;
    public $deskripsi;

    protected $listeners = [
        'JenjangCreate',
    ];

    public function JenjangCreate()
    {
        $this->resetInput();
        $this->emitSelf('render');
    }

    protected function rules()
    {
        return [
            'nama_jenjang'   => 'required|string|max:50',
            'deskripsi'   => 'nullable|string',
        ];
    }

    protected $messages = [
        'nama_jenjang.required' => 'Nama jenjang wajib diisi',
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
            JenjangKurikulum::create([
                'nama_jenjang'    => $validatedData['nama_jenjang'],
                'deskripsi'    => $validatedData['deskripsi'],
            ]);


            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Berhasil menambah periode!']);
            $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'JenjangCreate']);
            $this->emit('JenjangIndex');
            $this->resetInput();
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function resetInput()
    {
        $this->nama_jenjang = '';
        $this->deskripsi = '';
    }
    public function render()
    {
        return view('livewire.jenjang-kurikulum.create');
    }
}
