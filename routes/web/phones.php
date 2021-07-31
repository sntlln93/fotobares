<?php

use Illuminate\Support\Facades\Route;

Route::get('{phone}/edit', [\App\Http\Controllers\web\phones\EditPhone::class, 'edit'])->name('phones.edit');
Route::put('{phone}', [\App\Http\Controllers\web\phones\EditPhone::class, 'update'])->name('phones.update');
