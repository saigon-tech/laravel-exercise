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

class LoginController extends Controller
{

    function index()
    {
        return view('login');
    }
    function checklogin(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|exists:admins',
            'password'=> 'required |min:5'
        ]);

            $username = $request->input('username');
            $password = $request->input('password');


        if(Auth::attempt(['username'=>$username,'password'=>$password]))
        {
            return redirect('student');

        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
    }
}
