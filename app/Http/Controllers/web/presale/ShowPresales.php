<?php

namespace App\Http\Controllers\web\presale;

use App\Http\Controllers\Controller;
use App\Models\Presale;

class ShowPresales extends Controller
{
    public function index()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (array_search('admin', $roles) !== false) {
            $presales = Presale::all();
        } else {
            $presales = Presale::where('seller_id', auth()->user()->id)->get();
        }

        return view('presales.index')->with('presales', $presales);
    }
}
