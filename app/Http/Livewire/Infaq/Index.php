<?php

namespace App\Http\Livewire\Infaq;

use App\Models\KegiatanGenerus;
use App\Models\TRInfaq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $ms_kegiatan_generus_id;
    public $nama_kegiatan;
    public $tanggal_kegiatan;
    
    
    public $forms = [];
    public $editId = null;
    public $editForm = [];
    public $listInfaq = [];

    protected $listeners = ['InfaqCreate'];

    public function mount()
    {
        $this->addForm();
    }

    public function addForm()
    {
        $this->forms[] = [
            'nominal' => '',
            'tanggal' => now()->format('Y-m-d'),
            'keterangan' => '',
        ];
    }

    public function removeForm($index)
    {
        unset($this->forms[$index]);

        $this->forms = array_values(
            $this->forms
        );
    }

    public function loadInfaq()
    {
        $this->listInfaq = TRInfaq::with([
            'ms_pengguna'
        ])
        ->where(
            'ms_kegiatan_generus_id',
            $this->ms_kegiatan_generus_id
        )
        ->latest()
        ->get();
    }

    public function InfaqCreate($ms_kegiatan_generus_id)
    {
        $this->resetInput();

        $kegiatan = KegiatanGenerus::findOrFail($ms_kegiatan_generus_id);

        $this->ms_kegiatan_generus_id = $kegiatan->ms_kegiatan_generus_id;
        $this->nama_kegiatan  = $kegiatan->nama_kegiatan;
        $this->tanggal_kegiatan  = $kegiatan->tanggal;


        $this->forms = [];

        $this->addForm();

        $this->loadInfaq();
    }

    protected function rules()
    {
        return [

            'forms.*.nominal' => 'required|numeric|min:1000',
            'forms.*.tanggal' => 'required|date',
            'forms.*.keterangan' => 'nullable|string|max:500',
        ];
    }

    protected $messages = [
        'forms.*.nominal.required' => 'Nominal infaq wajib diisi.',
        'forms.*.nominal.numeric'  => 'Nominal harus berupa angka.',
        'forms.*.nominal.min'      => 'Minimal infaq Rp 1.000.',

        'forms.*.tanggal.required' => 'Tanggal wajib diisi.',
        'forms.*.tanggal.date'     => 'Format tanggal tidak valid.',

        'forms.*.keterangan.max'   => 'Keterangan maksimal 500 karakter.',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {

            foreach ($this->forms as $item) {

                TRInfaq::create([

                    'ms_kegiatan_generus_id' => $this->ms_kegiatan_generus_id,
                    'ms_pengguna_id' => Auth::id(),
                    'nominal' => $item['nominal'],
                    'tanggal' => $item['tanggal'],
                    'keterangan' => $item['keterangan'],
                ]);
            }

            DB::commit();

            $this->forms = [];

            $this->addForm();

            $this->loadInfaq();

            $this->emit('KegiatanIndex');

            $this->dispatchBrowserEvent('alertify-success',['message' => 'Berhasil menambahkan infaq']);
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error',['message' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $data = TRInfaq::findOrFail($id);

        $this->editId = $id;

        $this->editForm = [
            'nominal' => $data->nominal,
            'tanggal' => $data->tanggal,
            'keterangan' => $data->keterangan,
        ];
    }
    public function update()
    {
        $this->validate([
            'editForm.nominal' => 'required|numeric|min:1000',
            'editForm.tanggal' => 'required|date',
            'editForm.keterangan' => 'nullable|string|max:500',
        ]);

        TRInfaq::findOrFail($this->editId)->update($this->editForm);

        $this->editId = null;
        $this->editForm = [];
        $this->loadInfaq();
        $this->emit('KegiatanIndex');

        $this->dispatchBrowserEvent('alertify-success',['message' => 'Berhasil diperbarui'] );
    }

    public function delete($id)
    {
        $data = TRInfaq::find($id);

        if (!$data) {
            return;
        }

        $data->delete();

        if ($this->editId == $id) {

            $this->editId = null;

            $this->editForm = [];
        }

        $this->loadInfaq();
        $this->emit('KegiatanIndex');

        $this->dispatchBrowserEvent('alertify-success',['message' => 'Berhasil dihapus'] );
    }

    public function resetInput()
    {
        $this->ms_kegiatan_generus_id = null;
        $this->nama_kegiatan = null;
        $this->tanggal_kegiatan = null;

        $this->forms = [];

        $this->editId = null;
        $this->editForm = [];

        $this->listInfaq = [];
    }
    public function render()
    {
        return view('livewire.infaq.index');
    }
}
