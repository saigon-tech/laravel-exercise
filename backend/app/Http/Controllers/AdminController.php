<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('Student.adminlogin');
    }

    public function login(Request $request) {
        $admins = Admin::all();
        foreach($admins as $admin) {
            if($request->username == $admin->username and $request->password == $admin->password) {
                return redirect()->route('student-manager.index')->with('admin', $admin);
            }
        }
        return redirect()->back()->with('msg', 'Sai tên tài khoản hoặc mật khẩu!');
    }
}
