<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials))
        {
            // Authentication passed...
            return redirect()->intended('/login-success');
        }
            // Authentication unsuccessfully...
            return redirect()->intended('/login')->with('error', 'The username or password is incorrect');
    }

    public function loginSuccess()
    {
        return view ('login-success');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/login');
    }
}
