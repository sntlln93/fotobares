<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\web\clients\ShowAllClients::class, 'index'])->name('clients.index');
Route::get('/{client}', [App\Http\Controllers\web\clients\ShowClient::class, 'show'])->name('clients.show');