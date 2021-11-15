<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Models\Presale;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (array_search('admin', $roles) !== false) {
            return $this->homeForAdmins();
        }

        if (array_search('seller', $roles) !== false) {
            return $this->homeForSellers();
        }
    }

    private function homeForSellers()
    {
        $sales = Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product')
            ->where('seller_id', auth()->user()->id)
            ->get();

        $presales = Presale::query()
            ->where('seller_id', auth()->user()->id)
            ->get();

        return view('home.seller')->with('sales', $sales)->with('presales', $presales);
    }

    private function homeForAdmins()
    {
        $sales = Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product');
        
        $payments = $this->getPayments($sales->get());
        $deliveries = $sales
            ->whereHas('details', fn ($query) => $query->whereNotNull('edited_at')->whereNotNull('manufactured_at'))
            ->whereNull('delivered_at')
            ->orderBy('deliver_on')
            ->take(10)
            ->get();

        return view('home.admin')->with('deliveries', $deliveries)->with('payments', $payments);
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
