<?php

namespace App\Http\Livewire\Sistem\TemplatePesan;

use App\Models\TemplatePesanGenerus;
use Livewire\Component;

class Index extends Component
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
        'parameterUpdated' => 'setParameterDesa',
        'refreshPengguna' => 'loadTemplate'
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function setParameterDesa($desaId)
    {
        $this->ms_desa_id = $desaId;
        $this->loadTemplate();
    }

    protected function loadTemplate()
    {
        if (!$this->ms_desa_id) {
            $this->resetForm();
            return;
        }

        $template = TemplatePesanGenerus::query()
            ->where('ms_desa_id', $this->ms_desa_id)
            ->first();

        if (!$template) {
            $this->resetForm();
            return;
        }

        $this->template_pesan_generus_id = $template->template_pesan_generus_id;

        $this->judul            = $template->judul;
        $this->salam_pembuka    = $template->salam_pembuka;
        $this->kalimat_pembuka  = $template->kalimat_pembuka;
        $this->kalimat_penutup  = $template->kalimat_penutup;
        $this->salam_penutup    = $template->salam_penutup;

        $this->isEdit = true;
    }

    protected function resetForm()
    {
        $this->template_pesan_generus_id = null;

        $this->judul = null;
        $this->salam_pembuka = null;
        $this->kalimat_pembuka = null;
        $this->kalimat_penutup = null;
        $this->salam_penutup = null;

        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.sistem.template-pesan.index');
    }
}
