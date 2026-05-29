<?php

namespace App\Http\Livewire\AspekKurikulum;

use App\Models\AspekKurikulum;
use App\Models\JenjangKurikulum;
use App\Models\PeriodeKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $selectedPeriode;
    public $selectedJenjang;

    public $nama_aspek;
    public $urutan;
    public $deskripsi;

    protected $listeners = [
        'AspekCreate'
    ];

    public function AspekCreate($params)
    {
        $this->resetInput();
        $this->resetValidation();

        $this->selectedPeriode =
            $params['periode'];

        $this->selectedJenjang =
            $params['jenjang'];

        // AUTO URUTAN
        $this->urutan =
            (
                AspekKurikulum::where(
                    'ms_periode_kurikulum_id', $this->selectedPeriode
                )
                ->where(
                    'ms_jenjang_kurikulum_id',
                    $this->selectedJenjang
                )
                ->max('urutan') ?? 0
            ) + 1;
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

        'nama_aspek.required' =>
        'Nama aspek wajib diisi',

        'urutan.required' =>
        'Urutan aspek wajib diisi',
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
            AspekKurikulum::create([
                'ms_periode_kurikulum_id' => $this->selectedPeriode,
                'ms_jenjang_kurikulum_id' => $this->selectedJenjang,
                'nama_aspek' => $this->nama_aspek,
                'urutan' => $this->urutan,
                'deskripsi' => $this->deskripsi,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Aspek kurikulum berhasil ditambahkan!']);

            $this->dispatchBrowserEvent('hide-modal',['modalId' => 'AspekCreate']);

            $this->emit('AspekIndex');
            
            $this->resetInput();
        } catch (\Exception $e) {

            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Terjadi kesalahan : ' . $e->getMessage()]);
        }
    }

    public function resetInput()
    {
        $this->nama_aspek = '';
        $this->deskripsi = '';
        $this->urutan = 1;
    }

    public function render()
    {
        return view('livewire.aspek-kurikulum.create',[
            'periode' => PeriodeKurikulum::find($this->selectedPeriode),
            'jenjang' => JenjangKurikulum::find($this->selectedJenjang),
        ]);
    }
}
