<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('Login_view');
    }

    public function checklogin(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'username' => 'bail|required|exists:admins',
                'password' => 'bail|required',
            ],
            [
                'username.exists' => 'Account not exist',
            ]);
        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        } else {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('student');
            } else {
                return redirect('login')
                    ->with('thongBao', 'Login failed, please check your password')->withErrors($validator)
                    ->withInput();;
            }
        }

    }

}
