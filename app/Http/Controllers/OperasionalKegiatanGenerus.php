<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperasionalKegiatanGenerus extends Controller
{
    public function event()
    {
        return view('OPERASIONAL.kegiatan-event.v_index');
    }
    
    public function rutin()
    {
        return view('OPERASIONAL.kegiatan-rutin.v_index');
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
