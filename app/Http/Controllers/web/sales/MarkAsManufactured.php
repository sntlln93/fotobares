<?php

namespace App\Http\Controllers\web\sales;

use App\Models\SaleDetail;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MarkAsManufactured extends Controller
{
    public function index()
    {
        $details = SaleDetail::query()
        ->with('sale', 'photo', 'product')
            ->whereNotNull('edited_at')
            ->where(function ($query) {
                $query
                ->where('manufactured_at', '>=', Carbon::now()->subDays(7))
                ->orWhereNull('manufactured_at');
            })->get();
        
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

    public function undo(SaleDetail $detail)
    {
        $detail->update([
            'manufactured_at' => null,
        ]);

        return redirect()->back()
        ->with('message', ['type' => 'error', 'content' => $detail->product->name." registrado como no fabricado"]);
    }
}
