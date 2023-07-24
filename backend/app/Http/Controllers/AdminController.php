<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show login form
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('loginForm');
    }

    /**
     * Submit form login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/login-success');
        }
        return redirect()->intended('/login')->with('error','Login fail');
    }

    /**
     * Show login success page
     *
     * @return \Illuminate\View\View
     */
    public function loginSuccess()
    {
        return view('loginSuccess');
    }
}
