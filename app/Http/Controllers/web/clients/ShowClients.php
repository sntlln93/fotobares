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
            $clients = Client::with('phones', 'address')->get();
        } elseif (array_search('seller', $roles) !== false) {
            $clients = Client::with('phones', 'address')->where('seller_id', auth()->user->id)->get();
        }

        
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
