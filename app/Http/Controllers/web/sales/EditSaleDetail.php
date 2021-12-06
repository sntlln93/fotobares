<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditSaleDetail extends Controller
{
    public function edit(SaleDetail $saleDetail)
    {
        if ($saleDetail->sale->delivered_at) {
            return redirect()->back()->with(
                'message',
                ['type' => 'error', 'content' => 'No se puede modificar una venta que ya fue entregada']
            );
        }

        $products = Product::with('quotas')->get();

        return view('sales.details.edit')
        ->with('products', $products)
        ->with('detail', $saleDetail->load('product'));
    }

    public function update(SaleDetail $saleDetail, Request $request)
    {
        if ($saleDetail->sale->delivered_at) {
            return redirect()->back()->with(
                'message',
                ['type' => 'error', 'content' => 'No se puede modificar una venta que ya fue entregada']
            );
        }

        $validated = $request->validate([
            'color' => ['required'],
            'description' => ['nullable'],
            'code' => ['nullable'],
        ]);

        $saleDetail->update($validated);

        return redirect()->route('sales.show', ['sale' => $saleDetail->sale_id])
        ->with('message', ['type' => 'success', 'content' => 'Se ha modificado el detalle de la venta']);
    }
}
