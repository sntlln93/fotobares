<?php

namespace App\Http\Controllers\web\products;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Quota;

class EditProduct extends Controller
{
    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'quotas' => ['required'],
            'quotas.*.quantity' => ['required'],
            'quotas.*.quota_amount' => ['required'],
        ]);

        DB::transaction(function () use ($validated, $product) {
            $product->update([
                'name' => $validated['name'],
            ]);

            $product->quotas()->delete();

            for($i = 0; $i < count($validated['quotas']); $i++) {
                Quota::create([
                    'quantity' => $validated['quotas'][$i]['quantity'],
                    'quota_amount' => $validated['quotas'][$i]['quota_amount'],
                    'product_id' => $product->id
                ]);
            }
        });
        return redirect()->route('products.index', ['product' => $product->id])
            ->with('message', ['type' => 'success', 'content' => '¡Producto modificado con éxito!']);
    }
}
