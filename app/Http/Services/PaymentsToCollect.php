<?php

namespace App\Http\Services;

use App\Models\Sale;

class PaymentsToCollect
{
    public function get()
    {
        return Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product')
            ->whereNotNull('delivered_at')
            ->get()
            ->filter(fn ($sale) => $sale->nextPaymentToCollect)
            ->map(function ($sale) {
                return (object)[
                    'id' => $sale->nextPaymentToCollect->id,
                    'sale_id' => $sale->id,
                    'client' => (object)[
                        'id' => $sale->client_id,
                        'full_name' => $sale->client->full_name,
                        'has_location' => $sale->client->address->has_location,
                        'address' => $sale->client->address->formatted_address,
                    ],
                    'amount' => $sale->nextPaymentToCollect->amount,
                    'due_date' => $sale->nextPaymentToCollect->due_date,
                    'hour' => $sale->nextPaymentToCollect->hour,
                    'details' => $sale->details->map(function ($detail) {
                        return (object)[
                            'color' => $detail->color,
                            'product_name' => $detail->product->name,
                            'description' => $detail->description,
                        ];
                    }),
                    'phones' => $sale->client->phones->map(function ($phone) {
                        return $phone->id;
                    }),
                ];
            })->sortBy('due_date');
    }
}
