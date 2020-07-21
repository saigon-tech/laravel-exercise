<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as Controller;
use phpDocumentor\Reflection\Types\Array_;


class StudentController extends Controller
{
    public function getStudents(Request $request)
    {

        if($request->isMethod('post'))
        {
            $search = $request->input('search');
            if($search != "")
            {
                $students = Student::where('name',$search)->paginate(10);
                return view('students', ['students'=>$students]);
            }
        }
        $students = Student::paginate(10);
        return view('students', ['students'=>$students]);
    }
}
