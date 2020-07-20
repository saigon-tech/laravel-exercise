<?php

namespace App\Http\Controllers;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use mysql_xdevapi\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;




class Login_controller extends Controller
{
    public function index(Request $request)
    {
        return view('Login_view');
    }

    public function  checklogin(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'username' => 'bail|required|exists:admins',
                'password' => 'bail|required',
            ],
            [
                'username.exists' => 'Account not exist',
            ]);
        if ($validator->fails())
        {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('student');
            } else {
                return redirect('login')
                    ->with('thongBao','Login failed, please check your password');
            }
        }

//            $username = $request->input("username");
//            $passwrod = $request->input('password');
//            if(Auth::attempt(['username'=>$username,'password'=>$passwrod]))
//            {
//                return redirect('student');
//            }
//            else
//            {
//                return back()->with('error','Wrong Login Details');
//            }

    }

}
