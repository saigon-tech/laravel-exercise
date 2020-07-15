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
    protected  function  validator()
    {
        return Validator::make($data,[
           'username' => 'required|max:255',
            'password' => 'required|min:0',
        ]);
    }
    public function index(Request $request)
    {
        return view('Login_view');
    }

    public function  checklogin(Request $request)
    {
        $this->validate($request,[
           'username'=>'required|exists:admins',
            'password'=>'required|min:3',
        ]);

            $username = $request->input("username");
            $passwrod = $request->input('password');
            if(Auth::attempt(['username'=>$username,'password'=>$passwrod]))
            {
                return redirect('student');
            }
            else
            {
                return back()->with('error','Wrong Login Details');
            }

    }

}
