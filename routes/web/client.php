<?php

use Illuminate\Support\Facades\Route;

Route::get('/{client}/edit', [App\Http\Controllers\web\clients\EditClient::class, 'edit'])->name('clients.edit');
Route::put('/{client}', [App\Http\Controllers\web\clients\EditClient::class, 'update'])->name('clients.update');

Route::get('/', [App\Http\Controllers\web\clients\ShowClients::class, 'index'])->name('clients.index');
Route::get('/{client}', [App\Http\Controllers\web\clients\ShowClients::class, 'show'])->name('clients.show');