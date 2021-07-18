<?php

namespace App\Http\Controllers\web\endpoints;

use App\Http\Controllers\Controller;
use App\Models\Product;

class GetQuotasFromProduct extends Controller
{
    public function index(Product $product)
    {
        return $product->quotas;
    }
}
