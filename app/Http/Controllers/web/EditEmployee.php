<?php

namespace App\Http\Controllers\web;

use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EditEmployee extends Controller
{
    public function edit(Employee $employee)
    {
        $roles = Role::all();
        return view('employees.edit')
            ->with('employee', $employee)
            ->with('roles', $roles);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required',
            'username' => 'required',
            'roles' => 'required',
        ]);

        DB::transaction(function () use ($validated, $employee) {
            $employee->user->update([
                'username' => $validated['username'],
            ]);

            $employee->update([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
            ]);

            $employee->user->roles()->sync($validated['roles']);
        });

        return redirect()->route('employees.index');
    }
}
