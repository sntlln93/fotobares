<?php

namespace App\Http\Controllers\web\products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShowProducts extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('products.index')->with('products', $products);
    }

    public function show(Product $product)
    {
        return $product;
    }
}
