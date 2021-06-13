<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::get('/{client}', fn (Client $client) => $client)->name('clients.show');