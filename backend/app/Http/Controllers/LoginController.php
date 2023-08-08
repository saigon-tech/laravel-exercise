<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/student-list');
        }
        // Authentication unsuccessfully...
        return redirect()->intended('/login')->with('error', __('auth.failed'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/login');
    }
}
