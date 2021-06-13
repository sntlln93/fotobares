<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::get('/{client}', fn (Client $client) => $client->address)->name('map.show');