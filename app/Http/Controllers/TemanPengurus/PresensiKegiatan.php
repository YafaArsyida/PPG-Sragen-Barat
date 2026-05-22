<?php

namespace App\Http\Controllers\TemanPengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresensiKegiatan extends Controller
{
    public function index($token)
    {
        return view('TEMANPENGURUS.OPERASIONAL.presensi-kegiatan.v_index', [
            'token' => $token
        ]);
    }
}
