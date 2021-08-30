<?php

namespace App\Http\Controllers\web;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CreateEmployee extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('employees.create')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required',
            'password' => 'required',
            'username' => 'required|unique:users',
            'roles' => 'required',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
            ]);

            Employee::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'user_id' => $user->id,
            ]);

            $user->roles()->sync($validated['roles']);
        });

        return redirect()->route('employees.index')
            ->with('message', ['type' => 'success', 'content' => 'Empleado añadido con éxito!']);
    }
}
