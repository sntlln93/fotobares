<?php

use Illuminate\Support\Facades\Route;
use App\Models\Sale;

Route::get('/{sale}', fn (Sale $sale) => $sale)->name('deliver.form');