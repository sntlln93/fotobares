<?php

use Illuminate\Support\Facades\Route;

Route::get('/create', [App\Http\Controllers\web\sales\SellController::class, 'create'])->name('sales.create');
Route::post('/', [App\Http\Controllers\web\sales\SellController::class, 'store'])->name('sales.store');

Route::get('/', [App\Http\Controllers\web\sales\ShowSalesController::class, 'index'])->name('sales.index');
Route::get('/{sale}', [App\Http\Controllers\web\sales\ShowSalesController::class, 'show'])->name('sales.show');