<?php

namespace App\Http\Controllers;

use App\Enums\GradeSubjectEnum;
use App\Http\Requests\StudentListRequest;
use App\Http\Services\StudentService;
use Illuminate\View\View;

class StudentController extends Controller
{
    protected StudentService $studentService;
    public function __construct()
    {
        $this->studentService = resolve(StudentService::class);
    }
    /**
     * Display student's detail page.
     * @param  StudentListRequest  $request
     * @return View
     */
    public function index(StudentListRequest $request): View
    {
        $subjects = GradeSubjectEnum::asArray();
        $limit = config('constant.pagination_per_page');
        $students = $this->studentService->getStudentList($request->all())->paginate($limit);
        return view('student.list', compact('students', 'subjects'));
    }
}
