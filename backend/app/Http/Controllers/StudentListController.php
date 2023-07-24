<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function showStudentList(Request $request)
    {
        $sortBy = $request->sort_by ?? '';
        $sortOrder = $request->sort_order ?? '';
        $keyword = $request->keyword ?? '';

        if ($sortBy != '' && $sortOrder != '') {
            $students = Student::where('name', 'like', "%$keyword%")->orderBy($sortBy, $sortOrder)->paginate(10);
        } else $students = Student::where('name', 'like', "%$keyword%")->paginate(10);

        return view('studentList', compact('students', 'keyword', 'sortBy', 'sortOrder'));
    }

    public function createStudent(Request $request)
    {
        return view('studentDetail');
    }

    public function studentStore(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->birthday = $request->birthday;
        $student->save();

        $gradeMath = new Grade();
        $gradeMath->student_id = $student->id;
        $gradeMath->subject = 'math';
        $gradeMath->grade = $request->math;
        $gradeMath->save();


        $gradeMusic = new Grade();
        $gradeMusic->student_id = $student->id;
        $gradeMusic->subject = 'music';
        $gradeMusic->grade = $request->music;
        $gradeMusic->save();


        $gradeEnglish = new Grade();
        $gradeEnglish->student_id = $student->id;
        $gradeEnglish->subject = 'english';
        $gradeEnglish->grade = $request->english;
        $gradeEnglish->save();

        return redirect()->back()->with('success', 'Create success');
    }

    public function editStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $gradeMath = Grade::where([
            ['student_id', $id],
            ['subject', 'math']
        ])->get()->first();
        $gradeMusic = Grade::where([
            ['student_id', $id],
            ['subject', 'music']
        ])->get()->first();
        $gradeEnglish = Grade::where([
            ['student_id', $id],
            ['subject', 'english']
        ])->get()->first();
        return view('studentDetailEdit', compact('id', 'student', 'gradeMath', 'gradeMusic', 'gradeEnglish'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->birthday = $request->birthday;
        $student->save();

        $gradeMath = Grade::where([
            ['student_id', $id],
            ['subject', 'math']
        ])->get()->first();
        $gradeMath->student_id = $id;
        $gradeMath->subject = 'Math';
        $gradeMath->grade = $request->math;
        $gradeMath->save();

        $gradeMusic = Grade::where([
            ['student_id', $id],
            ['subject', 'music']
        ])->get()->first();
        $gradeMusic->student_id = $id;
        $gradeMusic->subject = 'Music';
        $gradeMusic->grade = $request->music;
        $gradeMusic->save();


        $gradeEnglish = Grade::where([
            ['student_id', $id],
            ['subject', 'english']
        ])->get()->first();
        $gradeEnglish->student_id = $id;
        $gradeEnglish->subject = 'English';
        $gradeEnglish->grade = $request->english;
        $gradeEnglish->save();

        return redirect()->back()->with('success', 'Edit success');
    }
}
