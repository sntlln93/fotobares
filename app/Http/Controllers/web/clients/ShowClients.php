<?php

namespace App\Http\Controllers\web\clients;

use App\Models\Sale;
use App\Models\Client;
use App\Http\Controllers\Controller;

class ShowClients extends Controller
{
    public function index()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (array_search('admin', $roles) !== false) {
            $clients = Client::with('phones', 'address', 'sales')->get();
        } elseif (array_search('seller', $roles) !== false) {
            $clients = Client::with('phones', 'address', 'sales')->where('seller_id', auth()->user->id)->get();
        }

        if (request()->has('active') && request()->get('active') == 1) {
            $clients = $clients->filter(fn ($client) => $client->sales->whereNull('delivered_at')->count() > 0);
        }

        $clients = $clients->map(function ($client) {
            return (object)[
                'id' => $client->id,
                'dni' => $client->dni,
                'fullName' => $client->full_name,
                'phones' => $client->phones,
                'address' => $client->address->formatted_address,
                'createdAt' => $client->created_at->diffForHumans(),
            ];
        });

        
        return view('clients.index')->with('clients', $clients);
    }

    public function show(Client $client)
    {
        $sales = Sale::where('client_id', $client->id)->get();

        return view('clients.show')
            ->with('client', $client)
            ->with('sales', $sales);
    }
}
