<?php

namespace App\Http\Controllers\web\presale;

use App\Models\Presale;
use App\Models\Product;
use App\Http\Controllers\Controller;

class SellFromPresale extends Controller
{
    public function create(Presale $presale)
    {
        $products = Product::all();
        
        return view('presales.create')
            ->with('products', $products)
            ->with('presale', $presale);
    }
}
