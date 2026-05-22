<?php

namespace App\Http\Controllers\TemanPengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanPengurus extends Controller
{
    public function index()
    {
        return view('TEMANPENGURUS.ADMINISTRASI.kegiatan-pengurus.v_index');
    }
}
