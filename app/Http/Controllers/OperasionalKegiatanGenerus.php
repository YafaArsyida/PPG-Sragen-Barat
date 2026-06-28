<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperasionalKegiatanGenerus extends Controller
{   
    public function laporan()
    {
        return view('OPERASIONAL.laporan-kegiatan.v_index');
    }
    
    public function kartu($token)
    {
        return view('OPERASIONAL.presensi-kegiatan-kartu.v_index', [
            'token' => $token
        ]);
    }
    public function manual($token)
    {
        return view('OPERASIONAL.presensi-kegiatan.v_index', [
            'token' => $token
        ]);
    }
}
