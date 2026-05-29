<?php

namespace App\Http\Livewire\AspekKurikulum;

use App\Models\AspekKurikulum;
use App\Models\JenjangKurikulum;
use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $ms_aspek_kurikulum_id;

    public $selectedPeriode;
    public $selectedJenjang;

    public $nama_aspek;
    public $urutan;
    public $deskripsi;

    protected $listeners = [
        'AspekEdit'
    ];

    public function AspekEdit($id)
    {
        $this->resetValidation();

        $aspek = AspekKurikulum::findOrFail($id);

        $this->ms_aspek_kurikulum_id = $aspek->ms_aspek_kurikulum_id;
        $this->selectedPeriode = $aspek->ms_periode_kurikulum_id;
        $this->selectedJenjang = $aspek->ms_jenjang_kurikulum_id;
        $this->nama_aspek = $aspek->nama_aspek;
        $this->urutan = $aspek->urutan;
        $this->deskripsi = $aspek->deskripsi;
    }

    protected function rules()
    {
        return [

            'nama_aspek' => 'required|string|max:100',

            'urutan' => 'required|integer|min:1',

            'deskripsi' => 'nullable|string|max:255',
        ];
    }

    protected $messages = [

        'nama_aspek.required' => 'Nama aspek wajib diisi',

        'urutan.required' => 'Urutan wajib diisi',
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

            AspekKurikulum::where('ms_aspek_kurikulum_id', $this->ms_aspek_kurikulum_id)

                ->update([
                    'nama_aspek' => $this->nama_aspek,
                    'urutan' => $this->urutan,
                    'deskripsi' => $this->deskripsi,
                ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success',['message' => 'Aspek kurikulum berhasil diperbarui!']);

            $this->dispatchBrowserEvent('hide-modal',['modalId' => 'AspekEdit']);

            $this->emit('AspekIndex');
            
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error',['message' =>'Terjadi kesalahan : ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.aspek-kurikulum.edit',[
            'periode' => PeriodeKurikulum::find(
                $this->selectedPeriode
            ),

            'jenjang' => JenjangKurikulum::find(
                $this->selectedJenjang
            ),
        ]);
    }
}
