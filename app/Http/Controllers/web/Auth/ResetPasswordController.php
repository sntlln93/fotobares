<?php

namespace App\Http\Controllers\web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.reset-password');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Contraseña incorrecta']);
        }
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect('/');
    }
}
