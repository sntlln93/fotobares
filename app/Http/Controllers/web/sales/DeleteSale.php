<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class DeleteSale extends Controller
{
    public function destroy(Sale $sale)
    {
        $sale->delete();
        
        return redirect()->route('sales.index')
            ->with('message', ['type' => 'error', 'content' => '¡Venta eliminada!']);
    }
}
