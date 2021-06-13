<?php

use Illuminate\Support\Facades\Route;
use App\Models\Employee;

Route::get('/{employee}', fn (Employee $employee) => $employee)->name('employees.show');