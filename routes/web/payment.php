<?php

use Illuminate\Support\Facades\Route;

Route::get('/payment', [App\Http\Controllers\web\payments\ShowPayments::class, 'index'])->name('payments.index');

Route::get('/{sale}', [App\Http\Controllers\web\payments\CollectPayment::class, 'index'])->name('collect');
Route::put('collect/{payment}', [App\Http\Controllers\web\payments\CollectPayment::class, 'update'])->name('collected');
Route::put('postpone/{payment}', [App\Http\Controllers\web\payments\PostponePayment::class, 'update'])->name('postponed');

Route::get('sales/{sale}/payments/edit', [App\Http\Controllers\web\payments\RecalculatePayments::class, 'edit'])->name('recalculate.form');
Route::put('sales/{sale}/payments', [App\Http\Controllers\web\payments\RecalculatePayments::class, 'update'])->name('recalculate');
