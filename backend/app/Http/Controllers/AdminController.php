<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    public function index(Request  $request) {
        return view('Student.adminlogin');
    }

    public function login(AdminRequest $request) {
        $validated = $request->only('username', 'password');
        if (Auth::attempt($validated)) {
            return redirect()->route('student.index');
        } else {
            return redirect()->back()->withErrors('Sai tên tài khoản hoặc mật khẩu!')->withInput();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
