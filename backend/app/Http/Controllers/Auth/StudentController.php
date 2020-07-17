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
    public function  addStudent(Request $request)
    {
        $student = new Student();
        if($request->isMethod('post'))
        {
            $student->name = $request->name;
            $student->birthday = $request->birthday;
            $student->save();

            if ($request->math != NULL) {
                $student->subjects()->save(new Grade([
                    'subject' => '1',
                    'grade' => $request->math,
                ]));
            }
            if ($request->music != NULL) {
                $student->subjects()->save(new Grade([
                    'subject' => '2',
                    'grade' => $request->music,
                ]));
            }
            if ($request->english != NULL) {
                $student->subjects()->save(new Grade([
                    'subject' => '3',
                    'grade' => $request->english,
                ]));
            }
        }
        return view('aestudent', ['student'=>$student]);
    }
    public function showEditstudent($id)
    {
        $student = Student::find($id);
        if ($student == NULL)
        {
            return view('students');
        }
        return view('aestudent', ['student' => $student]);
    }

    public function  editStudent(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->birthday = $request->birthday;
            $student->save();

            if ($request->math != NULL) {
                $student->subjects()->save(Grade([
                    'subject' => '1',
                    'grade' => $request->math,
                ]));
            } else
            {
                $student->subjects()->save(Grade([
                    'subject' => '1',
                    'grade' => '0',
                ]));
            }
            if ($request->music != NULL) {
                $student->subjects()->save(Grade([
                    'subject' => '2',
                    'grade' => $request->music,
                ]));
            } else
            {
                $student->subjects()->save(Grade([
                    'subject' => '2',
                    'grade' => '0',
                ]));
            }
            if ($request->english != NULL) {
                $student->subjects()->save(Grade([
                    'subject' => '3',
                    'grade' => $request->english,
                ]));
            } else
            {
                $student->subjects()->save(Grade([
                    'subject' => '3',
                    'grade' => '0',
                ]));
            }
        }
        $students = Student::paginate(10);
//        return view('students', ['students'=>$students]);
        return redirect()->route('students');
    }
}
