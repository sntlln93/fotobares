<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class ShowSales extends Controller
{
    public function index()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        $sales = Sale::with('seller', 'client', 'details');
        
        if (array_search('admin', $roles) === false) {
            $sales = $sales->where('seller_id', auth()->user()->id);
        }

        $sales = $sales->orderBy('id', 'desc')->get();

        return view('sales.index')->with('sales', $sales);
    }

    public function show(Sale $sale)
    {
        return view('sales.show')->with('sale', $sale);
    }
}
