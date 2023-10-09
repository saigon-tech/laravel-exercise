<?php

namespace App\Http\Services;

use App\Enums\GradeSubjectEnum;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentService
{
    static function render(?Request $request): View
    {
        $students = Student::paginate(2);
        $subjects = GradeSubjectEnum::asArray();
        $search = $request->input('searchInput');
        if ($search !== '') {
            $students = Student::query()->where('name', 'like', "%{$search}%")->paginate(2);
        }
        return view('student-detail', compact('students','subjects'));
    }
}
