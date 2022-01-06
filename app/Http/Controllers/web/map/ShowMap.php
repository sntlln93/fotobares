<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowMap extends Controller
{
    public function index()
    {
        return view('map.index');
    }
}
