<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KurikulumKBM extends Controller
{
    public function periodeDanJenjang()
    {
        return view('KurikulumKBM.periode-jenjang.v_index');
    }
    public function aspekDanMateri()
    {
        return view('KurikulumKBM.aspek-materi.v_index');
    }
    public function laporanKBM()
    {
        return view('KurikulumKBM.laporan-kbm.v_index');
    }
    public function monitoringKBM()
    {
        return view('KurikulumKBM.monitoring-kbm.v_index');
    }
}
