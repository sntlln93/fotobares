<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $sales = Sale::with('payments', 'client.phones', 'client.address', 'details.product')->get();
        
        return view('home')->with('sales', $sales);
    }
}
