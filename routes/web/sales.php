<?php

use Illuminate\Support\Facades\Route;

Route::get('/without-photo', [App\Http\Controllers\web\sales\AddImageToSoldProduct::class, 'index'])->name('without-photo.index');
Route::get('/without-photo/{detail}', [App\Http\Controllers\web\sales\AddImageToSoldProduct::class, 'edit'])->name('without-photo.edit');
Route::put('/without-photo/{detail}', [App\Http\Controllers\web\sales\AddImageToSoldProduct::class, 'update'])->name('without-photo.update');

Route::get('/create', [App\Http\Controllers\web\sales\SellProduct::class, 'create'])->name('sales.create');
Route::post('/', [App\Http\Controllers\web\sales\SellProduct::class, 'store'])->name('sales.store');

Route::get('/', [App\Http\Controllers\web\sales\ShowSales::class, 'index'])->name('sales.index');
Route::get('/{sale}', [App\Http\Controllers\web\sales\ShowSales::class, 'show'])->name('sales.show');


//helper endpoints
Route::get('/product/{product}/quotas', [App\Http\Controllers\web\endpoints\GetQuotasFromProduct::class, 'index']);