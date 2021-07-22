<?php

namespace App\Http\Controllers\web\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowAllClients extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index')->with('clients', $clients);
    }
}
