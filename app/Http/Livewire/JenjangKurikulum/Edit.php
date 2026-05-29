<?php

namespace App\Http\Livewire\JenjangKurikulum;

use App\Models\JenjangKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $ms_jenjang_kurikulum_id;
    public $nama_jenjang;
    public $deskripsi;

    protected $listeners = [
        'JenjangEdit',
    ];

    public function JenjangEdit($id)
    {
        $this->resetValidation();

        $jenjang = JenjangKurikulum::findOrFail($id);

        $this->ms_jenjang_kurikulum_id = $jenjang->ms_jenjang_kurikulum_id;

        $this->nama_jenjang = $jenjang->nama_jenjang;
        $this->deskripsi = $jenjang->deskripsi;
    }

    protected function rules()
    {
        return [
            'nama_jenjang' => 'required|string|max:50',
            'deskripsi'   => 'nullable|string',
        ];
    }

    protected $messages = [
        'nama_jenjang.required' =>
        'Nama jenjang wajib diisi',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {

            $jenjang = JenjangKurikulum::findOrFail(
                $this->ms_jenjang_kurikulum_id
            );

            $jenjang->update([
                'nama_jenjang' => $validated['nama_jenjang'],
                'deskripsi' => $validated['deskripsi'],
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Jenjang berhasil diperbarui!'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'JenjangEdit'
            ]);

            $this->emit('JenjangIndex');

            $this->reset([
                'ms_jenjang_kurikulum_id',
                'nama_jenjang',
                'deskripsi',
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
        return view('livewire.jenjang-kurikulum.edit');
    }
}
