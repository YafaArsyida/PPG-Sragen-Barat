<?php

namespace App\Http\Controllers;

use App\Models\ModelLogPeraga;
use App\Models\ModelPeraga;
use App\Models\ModelPerangkatPembaca;
use Illuminate\Http\Request;
use App\Models\ModelRFID;
use App\Models\ModelVideo;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DASHBOARD.v_index');
    }


    public function notula()
    {
        return view('DASHBOARD.notula.v_index');
    }
}
