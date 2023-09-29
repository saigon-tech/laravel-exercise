<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Get page login
     */
    public function login(): View {
        return view('login');
    }

    /**
     * Handle admin login
     */
    public function handleLogin (Request $request): RedirectResponse {
       $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
       ]);

       if (Auth::guard('admin')->attempt($credentials)){
           $request->session()->regenerate();
           return redirect()->intended('/students');
       }

        return redirect()->intended('/login')->with('error', 'The username or password is incorrect');
    }
}
