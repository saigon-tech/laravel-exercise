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
    public function login(): View|RedirectResponse {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('home');
        }
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
           return redirect()->intended();
       }

       return redirect()->route('login-page')->with('error', trans('auth.error_login'));
    }
}
