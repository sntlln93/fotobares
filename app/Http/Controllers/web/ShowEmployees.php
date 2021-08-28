<?php

namespace App\Http\Controllers\web;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ShowEmployees extends Controller
{
    public function index()
    {
        if (Gate::denies('see-employees')) {
            abort(403);
        }

        $employees = Employee::all();

        return view('employees.index')->with('employees', $employees);
    }

    public function show(Employee $employee)
    {
        if (Gate::denies('see-employees')) {
            abort(403);
        }

        return view('employees.show')->with('employee', $employee);
    }
}
