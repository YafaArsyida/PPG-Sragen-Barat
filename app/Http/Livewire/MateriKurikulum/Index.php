<?php

namespace App\Http\Livewire\MateriKurikulum;

use App\Models\MateriKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $ms_aspek_kurikulum_id;

    // CREATE MULTIPLE
    public $forms = [];

    // EDIT INLINE
    public $editId = null;

    public $editForm = [
        'nama_materi' => '',
        'uraian_materi' => '',
        'urutan' => 1,
    ];

    // | MOUNT
    public function mount($ms_aspek_kurikulum_id)
    {
        $this->ms_aspek_kurikulum_id =
            $ms_aspek_kurikulum_id;

        $this->addForm();
    }

    // GET DATA
    public function getDataProperty()
    {
        return MateriKurikulum::query()

            ->where(
                'ms_aspek_kurikulum_id',
                $this->ms_aspek_kurikulum_id
            )
            ->orderBy('urutan')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */

    public function addForm()
    {
        $nextUrutan =
            (
                MateriKurikulum::where(
                    'ms_aspek_kurikulum_id',
                    $this->ms_aspek_kurikulum_id
                )->max('urutan') ?? 0
            )
            + count($this->forms)
            + 1;

        $this->forms[] = [
            'nama_materi' => '',
            'uraian_materi' => '',
            'urutan' => $nextUrutan,
        ];
    }

    public function removeForm($index)
    {
        unset($this->forms[$index]);
        $this->forms = array_values($this->forms);
    }

    // EDIT INLINE
    public function edit($id)
    {
        $data =
            MateriKurikulum::findOrFail($id);

        $this->editId = $id;

        $this->editForm = [
            'nama_materi' =>$data->nama_materi,
            'uraian_materi' =>$data->uraian_materi,
            'urutan' =>$data->urutan,
        ];
    }

    public function cancelEdit()
    {
        $this->editId = null;

        $this->editForm = [
            'nama_materi' => '',
            'uraian_materi' => '',
            'urutan' => 1,
        ];
    }

    // VALIDATION
    protected function rules()
    {
        return [

            // CREATE
            'forms.*.nama_materi' => 'required|string|max:150',
            'forms.*.uraian_materi' => 'nullable|string|max:500',
            'forms.*.urutan' => 'required|integer|min:1',

            // EDIT
            'editForm.nama_materi' => 'required|string|max:150',
            'editForm.uraian_materi' => 'nullable|string|max:500',
            'editForm.urutan' => 'required|integer|min:1',
        ];
    }

    protected $messages = [

        'forms.*.nama_materi.required' => 'Nama materi wajib diisi',

        'editForm.nama_materi.required' => 'Nama materi wajib diisi',
    ];

    public function save()
    {
        $validated = $this->validateOnly(
            'forms'
        );
        DB::beginTransaction();
        try {
            foreach ($this->forms as $item) {
                // SKIP KOSONG
                if (
                    empty($item['nama_materi'])
                ) {
                    continue;
                }
                MateriKurikulum::create([
                    'ms_aspek_kurikulum_id' => $this->ms_aspek_kurikulum_id,
                    'nama_materi' => $item['nama_materi'],
                    'uraian_materi' => $item['uraian_materi'],
                    'urutan' => $item['urutan'],
                ]);
            }

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success',['message' =>'Materi berhasil ditambahkan']);

            // RESET
            $this->forms = [];

            $this->addForm();
        } catch (\Exception $e) {

            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error',['message' =>'Terjadi kesalahan : ' . $e->getMessage()]);
        }
    }
    public function update()
    {
        $this->validateOnly(
            'editForm'
        );

        DB::beginTransaction();

        try {
            MateriKurikulum::findOrFail($this->editId)->update($this->editForm);

            DB::commit();

            $this->cancelEdit();

            $this->dispatchBrowserEvent('alertify-success',['message' =>'Materi berhasil diperbarui']);
        } catch (\Exception $e) {

            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error',['message' => 'Terjadi kesalahan : ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $data = MateriKurikulum::find($id);
        if (!$data) {
            return;
        }

        if ($this->editId == $id) {
            $this->cancelEdit();
        }

        $data->delete();

        $this->dispatchBrowserEvent('alertify-success',['message' => 'Materi berhasil dihapus']);
    }

    public function render()
    {
        return view('livewire.materi-kurikulum.index');
    }
}
