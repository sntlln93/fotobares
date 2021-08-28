<?php

namespace App\Http\Controllers\web;

use App\Models\Employee;
use App\Http\Controllers\Controller;

class ShowEmployees extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index')->with('employees', $employees);
    }

    public function show(Employee $employee)
    {
        return view('employees.show')->with('employee', $employee);
    }
}
