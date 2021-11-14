<?php

namespace App\Http\Controllers\web\sales;

use App\Models\SaleDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarkAsManufactured extends Controller
{
    public function index()
    {
        $details = SaleDetail::query()
        ->with('sale', 'photo', 'product')
            ->has('photo')
            ->whereNull('manufactured_at')
            ->get();

        return view('manufacture.index')->with('details', $details);
    }

    public function update(SaleDetail $detail)
    {
        $detail->update([
            'manufactured_at' => now(),
        ]);

        return redirect()->back()
        ->with('message', ['type' => 'success', 'content' => $detail->product->name." registrado como fabricado"]);
    }
}
