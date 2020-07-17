<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Admin;


class LoginController extends Controller
{
    public function postLogin(Request $request)
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
                return redirect('home');
            } else {
                return redirect('login')
                    ->with('thongBao','Login failed, please check your password');
            }
        }
    }
}
