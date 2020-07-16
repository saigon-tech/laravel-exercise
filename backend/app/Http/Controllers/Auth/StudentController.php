<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use App\Subject;
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
        $students = Student::paginate(10);
        foreach ($students as $student) {
          //  $result['info'] = $student->subjects->toArray();
            $result = [
              key1 => value1
            ];
//            dump($student->subjects->where('subject', 1));
        }
        dd($result);
        return view('students', $result);
    }
}
