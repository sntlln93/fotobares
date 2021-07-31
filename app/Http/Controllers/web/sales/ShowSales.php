<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class ShowSales extends Controller
{
    public function index()
    {
        $sales = Sale::with('seller', 'client')->orderBy('id', 'desc')->paginate(20);

        return view('sales.index')->with('sales', $sales);
    }

    public function show(Sale $sale)
    {
        return view('sales.show')->with('sale', $sale);
    }
}
