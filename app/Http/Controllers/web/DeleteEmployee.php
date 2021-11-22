<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;

class DeleteEmployee extends Controller
{
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('employees.index')
        ->with('message', ['type' => 'error', 'content' => "Usuario eliminado correctamente"]);
    }
}
