<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentRequest;
use App\Http\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function studentList(StudentRequest $request)
    {
        $requests = $request->all();
        $students = $this->studentService->getList($request->all());
        $link = $students->appends([
            'keyword' => data_get($requests, 'keyword'),
            'field' => data_get($requests, 'field'),
            'order' => data_get($requests, 'order'),
        ]);
        return view('student-list', compact('students', 'link'));
    }
}
