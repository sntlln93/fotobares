<?php

namespace App\Http\Controllers\web\presale;

use App\Http\Controllers\Controller;
use App\Models\Presale;

class ShowPresales extends Controller
{
    public function index()
    {
        $presales = Presale::all();

        return view('presales.index')->with('presales', $presales);
    }
}
