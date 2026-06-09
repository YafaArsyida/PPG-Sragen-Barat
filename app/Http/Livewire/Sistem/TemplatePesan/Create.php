<?php

namespace App\Http\Livewire\Sistem\TemplatePesan;

use App\Models\TemplatePesanGenerus;
use Livewire\Component;

class Create extends Component
{
    public $template_pesan_generus_id;

    public $ms_desa_id;

    public $judul;
    public $salam_pembuka;
    public $kalimat_pembuka;
    public $kalimat_penutup;
    public $salam_penutup;

    public $isEdit = false;

    protected $listeners = [
        'parameterUpdated' => 'setParameterDesa'
    ];

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'salam_pembuka' => 'required|string',
            'kalimat_pembuka' => 'required|string',
            'kalimat_penutup' => 'required|string',
            'salam_penutup' => 'required|string',
        ];
    }

    public function setParameterDesa($desaId)
    {
        $this->ms_desa_id = $desaId;

        $this->loadTemplate();
    }

    public function loadTemplate()
    {
        if (!$this->ms_desa_id) {
            $this->resetForm();
            return;
        }

        $template = TemplatePesanGenerus::where(
            'ms_desa_id',
            $this->ms_desa_id
        )->first();

        if (!$template) {
            $this->resetForm();
            return;
        }

        $this->fill([
            'template_pesan_generus_id' => $template->template_pesan_generus_id,
            'judul' => $template->judul,
            'salam_pembuka' => $template->salam_pembuka,
            'kalimat_pembuka' => $template->kalimat_pembuka,
            'kalimat_penutup' => $template->kalimat_penutup,
            'salam_penutup' => $template->salam_penutup,
        ]);

        $this->isEdit = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {

            $template = TemplatePesanGenerus::findOrFail(
                $this->template_pesan_generus_id
            );

            $template->update([
                'judul' => $this->judul,
                'salam_pembuka' => $this->salam_pembuka,
                'kalimat_pembuka' => $this->kalimat_pembuka,
                'kalimat_penutup' => $this->kalimat_penutup,
                'salam_penutup' => $this->salam_penutup,
            ]);

            $message = 'Template berhasil diperbarui';
        } else {

            $template = TemplatePesanGenerus::create([
                'ms_desa_id' => $this->ms_desa_id,

                'judul' => $this->judul,
                'salam_pembuka' => $this->salam_pembuka,
                'kalimat_pembuka' => $this->kalimat_pembuka,
                'kalimat_penutup' => $this->kalimat_penutup,
                'salam_penutup' => $this->salam_penutup,

                'status' => 1,
            ]);

            $this->template_pesan_generus_id =
                $template->template_pesan_generus_id;

            $this->isEdit = true;

            $message = 'Template berhasil disimpan';
        }

        $this->emit('refreshPesan');
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => $message
        ]);
    }

    public function resetForm()
    {
        $this->template_pesan_generus_id = null;

        $this->judul = '';
        $this->salam_pembuka = '';
        $this->kalimat_pembuka = '';
        $this->kalimat_penutup = '';
        $this->salam_penutup = '';

        $this->isEdit = false;
    }
    public function render()
    {
        return view('livewire.sistem.template-pesan.create');
    }
}
