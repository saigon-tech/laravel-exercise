<?php

namespace App\Http\Controllers;
use App\Grade;
use App\Http\Requests\StudentRequest;
use App\Http\Services\StudentService;
use App\Student;
use Illuminate\Http\Request;

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
    public function  storeStudent(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->birthday = $request->birthday;
        $student->save();

        $gradeMath = new Grade();
        $gradeMath->student_id = $student->id;
        $gradeMath->subject = 'Math';
        $gradeMath->grade = $request->math;
        $gradeMath->save();

        $gradeMusic = new Grade();
        $gradeMusic->student_id = $student->id;
        $gradeMusic->subject = 'Music';
        $gradeMusic->grade = $request->music;
        $gradeMusic->save();

        $gradeEnglish = new Grade();
        $gradeEnglish->student_id = $student->id;
        $gradeEnglish->subject = 'English';
        $gradeEnglish->grade = $request->english;
        $gradeEnglish->save();

        return redirect()->back()->with('success', 'Student added');
    }
    public function editStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $gradeMath = Grade::where([
            ['student_id', $id],
            ['subject', 'Math']
        ])->get()->first();
        $gradeMusic = Grade::where([
            ['student_id', $id],
            ['subject', 'Music']
        ])->get()->first();
        $gradeEnglish = Grade::where([
            ['student_id', $id],
            ['subject', 'English']
        ])->get()->first();
        return view('student-info', compact('id', 'student', 'gradeMath', 'gradeMusic', 'gradeEnglish'));
    }
    public function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->birthday = $request->birthday;
        $student->save();

        $gradeMath = Grade::where([
            ['student_id', $id],
            ['subject', 'Math']
        ])->get()->first();
        $gradeMath->student_id = $id;
        $gradeMath->subject = 'Math';
        $gradeMath->grade = $request->math;
        $gradeMath->save();

        $gradeMusic = Grade::where([
            ['student_id', $id],
            ['subject', 'Music']
        ])->get()->first();
        $gradeMusic->student_id = $id;
        $gradeMusic->subject = 'Music';
        $gradeMusic->grade = $request->music;
        $gradeMusic->save();


        $gradeEnglish = Grade::where([
            ['student_id', $id],
            ['subject', 'English']
        ])->get()->first();
        $gradeEnglish->student_id = $id;
        $gradeEnglish->subject = 'English';
        $gradeEnglish->grade = $request->english;
        $gradeEnglish->save();

        return redirect()->back()->with('success', 'Edit success');
    }
}
