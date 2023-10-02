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
        /**
         * When user try to reach the login page, this function do a check:
         * If user logged in ( through check() function) they will be redirected to the welcome page.
         * If they didn't , they will be able to access the login page.
         */
        if (Auth::guard('admins')->check()) {
            return view('welcome');
        } else {
            return view('login');
        }
    }
    public function postLogin(Request $request): RedirectResponse
    {
        /**
         * This step takes the values from the input form and check validation before sending them to authenticating progress.
         */
        $credentials = $request->validate([
            'username' => 'required|min:6',
            'password' => 'required',
        ]);
        /**
         * When the values passed the validating test this step will check the authentication for user:
         * If the values work, refresh the session and redirect to the dashboard.
         * If the values did not match, throw an error after redirected them to the login page.
         */
        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->intended('/login')->with('login_fail', trans('auth.login_fail'));
    }
}

