<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getScore($student, $subject)
    {
        $score = DB::table('students')
            ->Join('grades', 'students.id', '=', 'grades.student_id')
            ->select('grades.subject', 'grades.grade')
            ->where('grades.student_id', '=', $student->id)
            ->where('grades.subject', '=', $subject)
            ->get();
        return $score[0]->grade;
    }

    public function index()
    {
        $students = Student::paginate(10);
        foreach ($students as $student) {
            $student->math = $this->getScore($student, 1);
            $student->music = $this->getScore($student, 2);
            $student->english = $this->getScore($student, 3);
            $student->gpa = number_format(($student->math+$student->music+$student->english)/3 ,2);
            if($student->gpa > 5.0) {
                $student->pass = 'Y';
            }
            else{
                $student->pass = 'N';
            }
        }
        return view('Student.students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
