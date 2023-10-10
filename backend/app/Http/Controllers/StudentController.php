<?php

namespace App\Http\Controllers;

use App\Http\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display student's detail page.
     * @param  Request|null  $request
     * @return View
     */
    public function index(?Request $request): View
    {
        $students = StudentService::getStudentList($request);
        return view('student.list', $students);
    }
}
