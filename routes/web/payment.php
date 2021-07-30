<?php

use Illuminate\Support\Facades\Route;

Route::get('/{sale}', [App\Http\Controllers\web\payments\CollectPayment::class, 'index'])->name('collect');
Route::put('collect/{payment}', [App\Http\Controllers\web\payments\CollectPayment::class, 'update'])->name('collected');
Route::put('postpone/{payment}', [App\Http\Controllers\web\payments\PostponePayment::class, 'update'])->name('postponed');