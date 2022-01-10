<?php

namespace App\Http\Controllers\web\map;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class GetClientPayment extends Controller
{
    public function get($clientId)
    {
        $sale = Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product', 'details.photo', 'seller')
            ->whereHas('details', fn ($query) => $query->whereNotNull('edited_at')->whereNotNull('manufactured_at'))
            ->where('client_id', $clientId)
            ->first();

        return $sale;
    }
}
