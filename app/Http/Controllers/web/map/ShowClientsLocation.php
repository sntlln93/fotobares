<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowClientsLocation extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('map.index')->with('clients', $clients);
    }
}
