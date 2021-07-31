<?php

namespace App\Http\Controllers\web\products;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quota;
use App\Models\Product;

class CreateProduct extends Controller
{
    public function create()
    {
        $product = new Product();
        return view('products.create')->with('product', $product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'quotas' => ['required'],
            'quotas.*.quantity' => ['required'],
            'quotas.*.quota_amount' => ['required'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::create([
                'name' => $validated['name']
            ]);

            for ($i = 0; $i < count($validated['quotas']); $i++) {
                Quota::create([
                    'quantity' => $validated['quotas'][$i]['quantity'],
                    'quota_amount' => $validated['quotas'][$i]['quota_amount'],
                    'product_id' => $product->id
                ]);
            }
        });

        return redirect()->route('products.index')
            ->with('message', ['type' => 'success', 'content' => 'Producto añadido con éxito!']);
    }
}
