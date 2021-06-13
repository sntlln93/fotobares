<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\web\Auth\LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [App\Http\Controllers\web\Auth\LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [App\Http\Controllers\web\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/change-password', [App\Http\Controllers\web\Auth\ResetPasswordController::class, 'showForm'])->name('password.form');
Route::post('/change-password', [App\Http\Controllers\web\Auth\ResetPasswordController::class, 'update'])->name('password.update');