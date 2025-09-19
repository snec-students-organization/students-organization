<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('institution.login'); // create view resources/views/institution/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('institution')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/institution/dashboard'); // Adjust redirect as needed
        }

        return back()->with('error', 'Invalid credentials.');

    }

    public function logout(Request $request)
    {
        Auth::guard('institution')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
