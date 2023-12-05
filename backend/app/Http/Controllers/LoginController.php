<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login page
    public function index(): View
    {
        return view('auth.login');
    }

    // Handle an authentication attempt
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        // Get credentials from request
        $credentials = $request->only('username', 'password');

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            // regenerate the session
            $request->session()->regenerate();
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        // Authentication failed, back to login page with error message
        return redirect()->back()->withInput()->with('error', __('auth.failed'));
    }
}
