<?php

use Illuminate\Support\Facades\Route;

Route::get('/create', ['App\Http\Controllers\web\CreateEmployee', 'create'])->name('employees.create');
Route::post('/', ['App\Http\Controllers\web\CreateEmployee', 'store'])->name('employees.store');

Route::get('/{employee}/edit', ['App\Http\Controllers\web\EditEmployee', 'edit'])->name('employees.edit');
Route::put('/{employee}', ['App\Http\Controllers\web\EditEmployee', 'update'])->name('employees.update');

Route::get('/', ['App\Http\Controllers\web\ShowEmployees', 'index'])->name('employees.index');
Route::get('/{employee}', ['App\Http\Controllers\web\ShowEmployees', 'show'])->name('employees.show');

Route::delete('/{user}', ['App\Http\Controllers\web\DeleteEmployee', 'destroy'])->name('employees.destroy');
