<?php

namespace App\Http\Controllers\web\deliveries;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class ShowDeliveries extends Controller
{
    public function index()
    {
        $sales = Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product')
            ->whereHas('details', fn ($query) => $query->whereNotNull('edited_at')->whereNotNull('manufactured_at'))
            ->whereNull('delivered_at')
            ->orderBy('deliver_on')
            ->get();

        return view('deliveries.index')->with('sales', $sales);
    }
}
