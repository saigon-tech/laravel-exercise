<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display login page with authenticated process.
     * @return View
     */
    public function getLogin(): View
    {
        if (Auth::guard('admins')->check()) {
            return view('welcome');
        } else {
            return view('login');
        }
    }

    /**
     * Validate, check authentication and redirect user after login.
     * @param  LoginRequest  $request
     * @return RedirectResponse
     */
    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if (Auth::guard('admins')->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->intended('/login')->with('login_fail', trans('auth.login_fail'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

