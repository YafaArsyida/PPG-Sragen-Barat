<?php

namespace App\Http\Livewire\Sistem\Pengguna;

use App\Models\Desa;
use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $ms_pengguna_id;
    public $nama;
    public $email;
    public $telepon;
    public $peran;
    public $created_at;
    public $scope_type;

    public $aksesPengguna = [];

    protected $listeners = [
        'refreshPengguna' => 'loadData'
    ];

    public function mount()
    {
        $this->loadData();
    }
    public function loadData()
    {
        $pengguna = User::with('ms_akses_pengguna')
            ->findOrFail(auth()->id());

        $this->ms_pengguna_id = $pengguna->ms_pengguna_id;
        $this->nama = $pengguna->nama;
        $this->email = $pengguna->email;
        $this->telepon = $pengguna->telepon;
        $this->peran = $pengguna->peran;
        $this->created_at = $pengguna->created_at->format('d M Y H:i');

        $akses = $pengguna->ms_akses_pengguna;

        if ($akses->isEmpty()) {
            $this->aksesPengguna = ['Tidak ada akses'];
            $this->scope_type = '-';
            return;
        }

        $scope = $akses->first()->scope_type;

        if ($scope == 'daerah') {
            $this->aksesPengguna = ['Semua Desa & Kelompok'];
        }

        if ($scope == 'desa') {
            $desaIds = $akses->pluck('scope_id');

            $this->aksesPengguna = Desa::whereIn('ms_desa_id', $desaIds)
                ->pluck('nama_desa')
                ->toArray();
        }

        if ($scope == 'kelompok') {
            $kelompokIds = $akses->pluck('scope_id');

            $this->aksesPengguna = Kelompok::whereIn('ms_kelompok_id', $kelompokIds)
                ->pluck('nama_kelompok')
                ->toArray();
        }

        $this->scope_type = $scope;
    }
    public function render()
    {
        return view('livewire.sistem.pengguna.index');
    }
}
