<?php

namespace App\Http\Controllers\web\sell;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('sell.create')->with('products', $products);
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
