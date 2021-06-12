<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $sales = [];//Sale::orderBy('id', 'desc')->take(10)->get();
        
        return view('home')->with('sales', $sales)
            ->with('payments', []);
    }

    public function sales()
    {
        $sales = Sale::with('seller', 'client')->orderBy('id', 'desc')->paginate(20);
        
        return view('sales.index')->with('sales', $sales);
    }
}
