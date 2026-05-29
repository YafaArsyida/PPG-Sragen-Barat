<?php

namespace App\Http\Livewire\PeriodeKurikulum;

use App\Models\PeriodeKurikulum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $ms_periode_kurikulum_id;
    public $nama_periode;
    public $deskripsi;
    public $tanggal_mulai;
    public $tanggal_selesai;

    protected $listeners = [
        'PeriodeEdit',
    ];

    public function PeriodeEdit($id)
    {
        $this->resetValidation();

        $periode = PeriodeKurikulum::findOrFail($id);
        $this->ms_periode_kurikulum_id = $periode->ms_periode_kurikulum_id;
        $this->nama_periode = $periode->nama_periode;
        $this->deskripsi = $periode->deskripsi;
        $this->tanggal_mulai = Carbon::parse($periode->tanggal_mulai)->format('Y-m-d');

        $this->tanggal_selesai = Carbon::parse($periode->tanggal_selesai)->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'nama_periode' => 'required|string|max:50',

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
        'nama_periode.required' =>
        'Nama periode wajib diisi',

        'tanggal_mulai.required' =>
        'Tanggal mulai wajib diisi',

        'tanggal_mulai.date' =>
        'Format tanggal mulai tidak valid',

        'tanggal_selesai.required' =>
        'Tanggal selesai wajib diisi',

        'tanggal_selesai.date' =>
        'Format tanggal selesai tidak valid',

        'tanggal_selesai.after_or_equal' =>
        'Tanggal selesai harus setelah tanggal mulai',
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
            $periode = PeriodeKurikulum::findOrFail(
                $this->ms_periode_kurikulum_id
            );

            $periode->update([
                'nama_periode'    => $validated['nama_periode'],
                'deskripsi'    => $validated['deskripsi'],
                'tanggal_mulai'   => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Periode berhasil diperbarui!'
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'PeriodeEdit'
            ]);

            $this->emit('PeriodeIndex');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.periode-kurikulum.edit');
    }
}
