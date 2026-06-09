<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SistemController extends Controller
{
    public function profil_pengguna()
    {
        return view('SISTEM.profil-pengguna.v_index');
    }
    public function akses_pengguna()
    {
        return view('SISTEM.akses-pengguna.v_index');
    }
    public function template_pesan()
    {
        return view('SISTEM.template-pesan.v_index');
    }
}
