<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.panel');
            } else {
                return redirect()->route('user.panel');
            }
        }
        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ])->withInput();
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
