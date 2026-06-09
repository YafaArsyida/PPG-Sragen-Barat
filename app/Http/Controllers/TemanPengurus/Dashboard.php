<?php

namespace App\Http\Controllers\TemanPengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        return view('TEMANPENGURUS.DASHBOARD.v_index');
    }

}
