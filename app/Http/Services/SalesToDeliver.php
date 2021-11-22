<?php

namespace App\Http\Services;

use App\Models\Sale;

class SalesToDeliver
{
    public function get()
    {
        return Sale::query()
        ->with('payments', 'client.phones', 'client.address', 'details.product')
        ->whereHas('details', fn ($query) => $query->whereNotNull('edited_at')->whereNotNull('manufactured_at'))
        ->whereNull('delivered_at')
        ->orderBy('deliver_on');
    }
}
