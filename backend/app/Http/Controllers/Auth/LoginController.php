<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as Controller;


class LoginController extends Controller
{
    public function loginviews(Request $request)
    {
        return view('login');
    }

    public function check_login(Request $request)
    {
        $request->validate([
            'username'=>'required|exists:admins',
            'password'=>'required|min:6',
        ],[
            'username.required' =>'Bạn chưa nhập username',
            'password.required' => 'Bạn chưa nhập password',
            'password.min' => 'Password ít nhất 6 kí tự'
        ]);
        if(Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            return redirect('student');
        }
        else
        {
            return redirect()->back()->with('error','Sai username hoặc password');
        }

    }

}
