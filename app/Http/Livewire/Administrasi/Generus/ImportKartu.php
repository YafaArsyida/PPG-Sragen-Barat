<?php

namespace App\Http\Livewire\Administrasi\Generus;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportKartuGenerus;
use App\Imports\ImportKartuGenerus;
use App\Models\Generus;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class ImportKartu extends Component
{
    use WithFileUploads;

    public $ms_kelompok_id;

    public $oldGenerusList = [];

    public $file_import;

    public $newGenerusList = [];

    protected $listeners = [
        'showImportKartu'
    ];

    public function showImportKartu($ms_kelompok_id)
    {
        $this->ms_kelompok_id = $ms_kelompok_id;

        $this->newGenerusList = [];

        // $this->oldGenerusList = Generus::where(
        //     'ms_kelompok_id',
        //     $ms_kelompok_id
        // )
        //     ->orderBy('nama_generus')
        //     ->get();
    }
    public function exportKartuGenerus()
    {
        $generus = Generus::where(
            'ms_kelompok_id',
            $this->ms_kelompok_id
        )
            ->orderBy('nama_generus')
            ->get();

        if ($generus->isEmpty()) {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data generus tidak ditemukan.'
            ]);

            return;
        }

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Menyiapkan dokumen...'
        ]);

        return Excel::download(
            new ExportKartuGenerus($generus), 'kartu-generus-' . now()->format('Ymd') . '.xlsx'
        );
    }
    protected function rules()
    {
        return [
            'file_import' => 'required|mimes:xlsx,xls,csv',
        ];
    }

    protected $messages = [
        'file_import.required' => 'File Excel wajib diunggah untuk melanjutkan.',
        'file_import.mimes' => 'File harus berupa format: xlsx, xls, atau csv.',
    ];

    public function updatedFileImport()
    {
        $this->validate([
            'file_import' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {

            $import = new ImportKartuGenerus();

            Excel::import($import, $this->file_import);

            $this->newGenerusList = $import
                ->getCollection()
                ->toArray();

            $this->dispatchBrowserEvent('alertify-success',['message' => 'File berhasil dibaca.']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alertify-error',['message' => $e->getMessage()]);
        }
    }
    public function saveChanges()
    {
        if (!is_array($this->newGenerusList) || empty($this->newGenerusList)) {
            $this->dispatchBrowserEvent(
                'alertify-error', ['message' => 'Tidak ada data yang akan diperbarui.']);

            return;
        }

        DB::beginTransaction();

        try {

            $updated = 0;

            foreach ($this->newGenerusList as $row) {

                if (empty($row['ms_generus_id'])) {
                    continue;
                }

                $generus = Generus::find(
                    $row['ms_generus_id']
                );

                if (!$generus) {
                    continue;
                }

                $nomorKartuBaru = trim(
                    $row['nomor_kartu'] ?? ''
                );

                if (
                    $generus->nomor_kartu != $nomorKartuBaru
                ) {

                    $generus->update([
                        'nomor_kartu' => $nomorKartuBaru
                    ]);

                    $updated++;
                }
            }

            DB::commit();

            $this->dispatchBrowserEvent(
                'alertify-success',
                [
                    'message' => $updated . ' data kartu berhasil diperbarui.'
                ]
            );

            $this->newGenerusList = [];
            $this->file_import = null;

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'ModalImportKartu'
            ]);

            $this->emit('GenerusIndex');
        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error',['message' => $e->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.administrasi.generus.import-kartu');
    }
}
