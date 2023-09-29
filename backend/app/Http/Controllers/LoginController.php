<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;

class LoginController extends Controller
{
    public function getLogin():view
    {
        if (Auth::guard('admins')->check()) {
            return view('welcome');
        } else {
            return view('login');
        }
    }
    public function postLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required|min:6',
            'password' => 'required',
        ]);
        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->intended('/login')->with('logged-in', trans('logged_in'));
    }
}

