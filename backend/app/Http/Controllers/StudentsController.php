<?php


namespace App\Http\Controllers;
use App\StudentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $y = new StudentModel();

        if($request->isMethod('post'))
        {
            $search = $request->input('search');
            if($search != "")
            {
                $x = $y->Search($request);
                return view('student')->with('data', $x);
            }
        }

        $x = $y->listST();
        return view('student')->with('data', $x);
    }

    public  function add(Request $request)
    {
        $st = new StudentModel();
        if($request ->isMethod('post'))
        {
            $st->add($request);
            return  redirect('student');
        }
        return view('add');
    }

    public function edit(Request $request,$id = false)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $student->edit($request);
            return  redirect('student');
        }
        $students = $student->listSTEdit($id);
        return view('edit')->with('data', $students);
    }

}
