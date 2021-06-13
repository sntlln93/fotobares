<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\web\HomeController::class, 'home'])->name('home');