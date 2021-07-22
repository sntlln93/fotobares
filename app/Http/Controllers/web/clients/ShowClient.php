<?php

namespace App\Http\Controllers\web\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowClient extends Controller
{
    public function show(Client $client)
    {
        return view('clients.show')->with('client', $client);
    }
}
