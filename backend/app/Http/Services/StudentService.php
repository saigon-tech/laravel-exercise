<?php

namespace App\Http\Services;

use App\Enums\GradeSubjectEnum;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentService
{
    /**
     * Get student list or searched student list
     * @param  Request|null  $request
     * @return array
     */
    public static function getStudentList(?Request $request): array
    {
        $students = Student::paginate(2);
        $subjects = GradeSubjectEnum::asArray();
        $search = $request->input('searchInput');
        if ($search !== '') {
            $students = Student::query()->where('name', 'like', "%{$search}%")->paginate(2);
        }
        return ['students' => $students, 'subjects' => $subjects];
    }
}
