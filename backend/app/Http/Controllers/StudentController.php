<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Services\StudentService;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentList(StudentRequest $request){
        return null;
    }
}
