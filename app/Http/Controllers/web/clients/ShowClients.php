<?php

namespace App\Http\Controllers\web\clients;

use App\Models\Client;
use App\Http\Controllers\Controller;

class ShowClients extends Controller
{
    public function index()
    {
        $clients = Client::all();
        
        return view('clients.index')->with('clients', $clients);
    }

    public function show(Client $client)
    {
        return view('clients.show')->with('client', $client);
    }
}
