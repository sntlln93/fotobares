<?php

use Illuminate\Support\Facades\Route;

Route::get('/{sale}', [App\Http\Controllers\web\payments\CollectPayment::class, 'index'])->name('collect');
Route::put('/{payment}', [App\Http\Controllers\web\payments\CollectPayment::class, 'update'])->name('collected');