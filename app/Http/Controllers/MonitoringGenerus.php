<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringGenerus extends Controller
{
    public function kegiatanGenerus()
    {
        return view('MONITORING.kegiatan-generus.v_index');
    }
}
