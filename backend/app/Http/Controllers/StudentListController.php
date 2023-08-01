<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function studentList(Request $request)
    {
        $sortBy = $request->sort_by ?? '';
        $sortOrder = $request->sort_order ?? '';
        $keyword = $request->keyword ?? '';

        if ($sortBy != '' && $sortOrder != '') {
            $students = Student::where('name', 'like', "%$keyword%")->orderBy($sortBy, $sortOrder)->paginate(10);
        } else $students = Student::where('name', 'like', "%$keyword%")->paginate(10);

        return view('student-list', compact('students', 'keyword', 'sortBy', 'sortOrder'));
    }
}
