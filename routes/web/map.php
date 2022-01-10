<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\map\ShowClientLocation;
use App\Http\Controllers\web\map\ShowMap;
use App\Http\Controllers\web\map\GetClientPayment;

Route::get('clients', [ShowMap::class, 'getClients']);
Route::get('client/{clientId}', [GetClientPayment::class, 'get']);
Route::get('/{client}', [ShowClientLocation::class, 'show'])->name('map.show');
Route::get('/', [ShowMap::class, 'index'])->name('map.index');
