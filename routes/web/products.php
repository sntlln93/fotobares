<?php

use Illuminate\Support\Facades\Route;

Route::get('/create', [App\Http\Controllers\web\products\CreateProduct::class, 'create'])->name('products.create');
Route::post('/', [App\Http\Controllers\web\products\CreateProduct::class, 'store'])->name('products.store');

Route::get('/', [App\Http\Controllers\web\products\ShowProducts::class, 'index'])->name('products.index');
Route::get('/{product}', [App\Http\Controllers\web\products\ShowProducts::class, 'show'])->name('products.show');

Route::get('/{product}/edit', [App\Http\Controllers\web\products\EditProduct::class, 'edit'])->name('products.edit');
Route::put('/{product}', [App\Http\Controllers\web\products\EditProduct::class, 'update'])->name('products.update');

Route::delete('{product}', [App\Http\Controllers\web\products\DeleteProduct::class, 'destroy'])->name('products.delete');