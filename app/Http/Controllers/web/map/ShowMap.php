<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ShowMap extends Controller
{
    public function index()
    {
        if (!request()->has('clients')) {
            return view('map.index');
        }

        $clientsId = json_decode(request()->clients);
        $clients = Client::find($clientsId)->load('address');

        return response()
            ->json($clients);
    }
}
