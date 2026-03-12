<?php

namespace App\Http\Controllers\Lib;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoamingDataController extends Controller
{
    public function index()
    {
        return view('home.lib.roaming-data.index');
    }
}
