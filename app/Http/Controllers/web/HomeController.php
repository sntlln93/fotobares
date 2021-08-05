<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $sales = Sale::with('payments', 'client.phones', 'client.address', 'details.product')->get();
        
        $payments = $this->getPayments($sales);

        return view('home')->with('sales', $sales)->with('payments', $payments);
    }

    private function getPayments($sales)
    {
        return $sales->filter(function ($sale) {
            return $sale->nextPaymentToCollect;
        })->map(function ($sale) {
            return (object)[
                'id' => $sale->nextPaymentToCollect->id,
                'sale_id' => $sale->id,
                'client' => (object)[
                    'id' => $sale->client_id,
                    'full_name' => $sale->client->full_name,
                    'has_location' => $sale->client->address->has_location,
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
                'delivered_at' => $sale->delivered_at,
            ];
        })->sortBy('due_date')
        ->take(10);
    }
}
