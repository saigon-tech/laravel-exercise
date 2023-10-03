<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use  App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display student's detail page.
     * @return View
     */
    public function index(): View
    {
        $students = Student::paginate(2);
        return view('student-detail', compact('students'));
    }

    /**
     * Search-by-name function
     * @param  Request  $request
     * @return View
     */
    public function search(Request $request)
    {
        $search = $request->input('searchInput');
        if ($search === '') {
            $students = Student::paginate(2);
            return view('student-detail', compact('students'));
        }
        else{
            $students = Student::query()->where('name','like',"%{$search}%")->paginate(2);
            return view('student-detail', compact('students'));
        }
    }
}
