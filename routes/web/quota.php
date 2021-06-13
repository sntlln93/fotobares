<?php

use Illuminate\Support\Facades\Route;

Route::get('/{sale}', [App\Http\Controllers\web\collect\CollectController::class, 'index'])->name('collect.index');
Route::get('/collect/{payment}', [App\Http\Controllers\web\collect\CollectController::class, 'index'])->name('collect.form');