<?php

use Illuminate\Support\Facades\Route;

Route::get('/{client}', [App\Http\Controllers\web\map\ShowClientLocation::class, 'show'])->name('map.show');
Route::get('/', [App\Http\Controllers\web\map\ShowClientsLocation::class, 'index'])->name('map.index');