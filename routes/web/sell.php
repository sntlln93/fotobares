<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\web\HomeController::class, 'sales'])->name('sales.index');
Route::get('/new', [App\Http\Controllers\web\sell\SellController::class, 'create'])->name('sales.create');
Route::post('/', [App\Http\Controllers\web\sell\SellController::class, 'store'])->name('sales.store');
