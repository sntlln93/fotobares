<?php

use Illuminate\Support\Facades\Route;

Route::get('/{address}/edit', [App\Http\Controllers\web\addresses\EditAddress::class, 'edit'])->name('addresses.edit');
Route::put('/{address}', [App\Http\Controllers\web\addresses\EditAddress::class, 'update'])->name('addresses.update');
