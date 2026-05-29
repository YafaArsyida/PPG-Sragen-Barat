<?php

namespace App\Http\Livewire\PenilaianKurikulum;

use App\Models\MateriKurikulum;
use App\Models\PenilaianMateriKurikulum;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Evaluation extends Component
{
    public $ms_aspek_kurikulum_id;
    public $ms_kelompok_id;
    public $ms_periode_kurikulum_id;
    public $ms_jenjang_kurikulum_id;

    // | SUPER CRUD
    public $editId = null;

    public $editForm = [
        'kehadiran' => '',
        'keberhasilan' => '',
        'catatan' => '',
    ];

    // | DATA
    public function mount($ms_aspek_kurikulum_id, $ms_kelompok_id, $ms_periode_kurikulum_id, $ms_jenjang_kurikulum_id) 
    {
        $this->ms_aspek_kurikulum_id = $ms_aspek_kurikulum_id;
        $this->ms_kelompok_id = $ms_kelompok_id;
        $this->ms_periode_kurikulum_id = $ms_periode_kurikulum_id;
        $this->ms_jenjang_kurikulum_id = $ms_jenjang_kurikulum_id;
    }

    public function getDataProperty()
    {
        return MateriKurikulum::query()

            ->with([
                'trx_penilaian_materi' => function ($q) {
                    $q->where('ms_kelompok_id', $this->ms_kelompok_id)
                    ->where('ms_periode_kurikulum_id', $this->ms_periode_kurikulum_id)
                    ->where('ms_jenjang_kurikulum_id', $this->ms_jenjang_kurikulum_id);
                }
            ])

            ->where('ms_aspek_kurikulum_id', $this->ms_aspek_kurikulum_id)
            ->orderBy('urutan')
            ->get();
    }

    // | EDIT
    public function edit($id)
    {
        $this->resetValidation();

        $this->editId = $id;

        $penilaian = PenilaianMateriKurikulum::where(
            'ms_materi_kurikulum_id',
            $id
        )
            ->where(
                'ms_kelompok_id',
                $this->ms_kelompok_id
            )
            ->where(
                'ms_periode_kurikulum_id',
                $this->ms_periode_kurikulum_id
            )
            ->where(
                'ms_jenjang_kurikulum_id',
                $this->ms_jenjang_kurikulum_id
            )
            ->first();

        $this->editForm = [
            'kehadiran' => $penilaian?->kehadiran,
            'keberhasilan' => $penilaian?->keberhasilan,
            'catatan' => $penilaian?->catatan,
        ];
    }

    public function cancelEdit()
    {
        $this->editId = null;

        $this->reset('editForm');
    }

    // | VALIDATION
    protected function rules()
    {
        return [
            'editForm.kehadiran' => 'required|numeric|min:0|max:100',

            'editForm.keberhasilan' => 'required|numeric|min:0|max:100',

            'editForm.catatan' => 'nullable|string|max:500',
        ];
    }

    protected $messages = [
        'editForm.kehadiran.required' => 'Kehadiran wajib diisi',

        'editForm.kehadiran.max' => 'Maksimal 100%',

        'editForm.keberhasilan.required' => 'Keberhasilan wajib diisi',

        'editForm.keberhasilan.max' => 'Maksimal 100%',

        'editForm.catatan.max' => 'Catatan maksimal 500 karakter',
    ];

   
    // | SAVE
    public function update()
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {

            PenilaianMateriKurikulum::updateOrCreate(

                [
                    'ms_kelompok_id' => $this->ms_kelompok_id,
                    'ms_periode_kurikulum_id' => $this->ms_periode_kurikulum_id,
                    'ms_jenjang_kurikulum_id' => $this->ms_jenjang_kurikulum_id,
                    'ms_materi_kurikulum_id' => $this->editId,
                ],

                [
                    'kehadiran' => $this->editForm['kehadiran'],
                    'keberhasilan' => $this->editForm['keberhasilan'],
                    'catatan' => $this->editForm['catatan'],
                    'status' => 'draft',
                ]

            );

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Penilaian berhasil disimpan'
            ]);
            $this->cancelEdit();
            $this->emitUp('AspekIndex');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ]);
        }
    }
    public function render()
    {
        return view('livewire.penilaian-kurikulum.evaluation');
    }
}
