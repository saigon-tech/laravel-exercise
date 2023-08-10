<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Services\StudentService;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function addStudent(Request $request)
    {
        return view('student-info');
    }

    public function storeStudent(StudentStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->studentService->store($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Student added');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Add Student Fail');
        }
    }

    public function editStudent(Student $student)
    {
        $grades = $student->grades->pluck('grade', 'subject');
        return view('student-info', compact('student', 'grades'));
    }

    public function updateStudent(StudentUpdateRequest $request, Student $student)
    {
        try {
            DB::beginTransaction();
            $this->studentService->update($student, $request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Edit success');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Edit Fail');
        }
    }
}
