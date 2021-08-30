<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\web\presale\ShowPresales::class, 'index'])->name('presale.index');
Route::post('/', [App\Http\Controllers\web\presale\CreatePresale::class, 'store'])->name('presale.store');
Route::get('/sell/{presale}', [App\Http\Controllers\web\presale\SellFromPresale::class, 'create'])->name('presale.create');
Route::post('/sell', [App\Http\Controllers\web\presale\SellFromPresale::class, 'store'])->name('presale.sell');
