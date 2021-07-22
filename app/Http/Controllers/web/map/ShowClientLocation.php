<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowClientLocation extends Controller
{
    public function show(Client $client)
    {
        return view('map.show')->with('client', $client);
    }
}
