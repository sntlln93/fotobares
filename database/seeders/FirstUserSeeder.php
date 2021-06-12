<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'gtobares',
            'password' => Hash::make('contrasena')
        ]);

        $user->roles()->attach(Role::first());

        Employee::create([
            'name' => 'Gabriela',
            'lastname' => 'Tobares',
            'user_id' => $user->id
        ]);

        $user = User::create([
            'username' => 'flor',
            'password' => Hash::make('contrasena')
        ]);

        $user->roles()->attach(Role::first());

        Employee::create([
            'name' => 'Florencia',
            'lastname' => 'Tobares',
            'user_id' => $user->id
        ]);

        $user = User::create([
            'username' => 'brenda',
            'password' => Hash::make('contrasena')
        ]);

        $user->roles()->attach(Role::first());

        Employee::create([
            'name' => 'Brenda',
            'lastname' => 'Tobares',
            'user_id' => $user->id
        ]);
    }
}
