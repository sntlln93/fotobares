<?php

namespace App\Http\Controllers\web\collect;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class CollectController extends Controller
{
    public function index(Sale $sale)
    {
        return view('collect.index')->with('sale', $sale->load('payments'));
    }
}