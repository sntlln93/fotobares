<?php

namespace App\Http\Controllers\web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withInput()->withErrors([
            'username' => 'Nombre de usuario o contraseña incorrectos.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
