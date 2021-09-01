<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('Student.adminlogin');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6|bail',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $request->only('username', 'password');
        if (Auth::attempt($validated)) {
            return redirect('testLogin');
        } else {
            return redirect()->back()->withErrors('Sai tên tài khoản hoặc mật khẩu!')->withInput();
        }
    }
}
