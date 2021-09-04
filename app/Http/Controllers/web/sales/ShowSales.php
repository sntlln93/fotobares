<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class ShowSales extends Controller
{
    public function index()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (array_search('admin', $roles) !== false) {
            $sales = Sale::with('seller', 'client')
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $sales = Sale::with('seller', 'client')
                ->where('seller_id', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->paginate(20);
        }



        return view('sales.index')->with('sales', $sales);
    }

    public function show(Sale $sale)
    {
        return view('sales.show')->with('sale', $sale);
    }
}
