<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('loginForm');
    }

    public function submitForm(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/login-success');
        }
        return redirect()->intended('/login')->with('error','Login fail');
    }
    public function loginSuccess()
    {
        return view('loginSuccess');
    }
    public function logout()
    {
       Auth::logout();
       return redirect()->intended('/login');
    }
}
