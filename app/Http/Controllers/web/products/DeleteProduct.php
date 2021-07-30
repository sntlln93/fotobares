<?php

namespace App\Http\Controllers\web\products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteProduct extends Controller
{
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
        ->with('message', ['type' => 'info', 'content' => 'Producto eliminado con éxito!']);
    }
}
