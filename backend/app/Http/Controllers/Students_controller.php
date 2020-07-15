<?php

namespace App\Http\Controllers;
use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Students_controller extends Controller
{
    public function index(Request $request)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $search = $request->input('search');
            if($search != "")
            {
                $students = $student->Search($request);
                return view('Students_view')->with('data', $students);
            }
        }
        $students = $student->GetList();
        return view('Students_view')->with('data', $students);
    }

    public function  addstudent(Request $request)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $student->AddStudent($request);
            return  redirect('/student');
        }
        return view('addstudent_view');
    }

    public function  editstudent(Request $request,$id = false)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $student->EditStudent($request);
            return redirect('/student');
        }

        $students = $student->GetLisEdit($id);
        return view('editstudent_view')->with('data', $students);
    }

}
