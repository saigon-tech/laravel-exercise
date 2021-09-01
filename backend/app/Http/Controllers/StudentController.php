<?php

namespace App\Http\Controllers;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchStudentRequest;
use App\Http\Requests\StoreStudentRequest;

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
            $this->extracted($student);
        }
        $admin = Auth::user()->username;
        return view('Student.students')->with('admin', $admin)->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $header = $request->add;
        $admin = Auth::user()->username;
        return view('Student.createform')->with('admin', $admin)->with('header', $header);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->only('search');
        $students = Student::all();
        $students->each(function ($item, $itemKey) use($validated, $students) {
            if(strpos(strtoupper($item->name), strtoupper($validated['search'])) > -1) {
                $this->extracted($item);
            } else {
                unset($students[$itemKey]);
            }
        });
        $admin = Auth::user()->username;
        return view('Student.students')->with('admin', $admin)->with('students', $students);
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

    public function search(SearchStudentRequest $request)
    {
        $validated = $request->only('search');
        $students = Student::all();
        $students->each(function ($item, $itemKey) use($validated, $students) {
            if(strpos(strtoupper($item->name), strtoupper($validated['search'])) > -1) {
                $this->extracted($item);
            } else {
                unset($students[$itemKey]);
            }
        });
        $admin = Auth::user()->username;
        return view('Student.students')->with('admin', $admin)->with('students', $students);
    }

    /**
     * @param $student
     */
    public function extracted($student): void
    {
        $student->math = $this->getScore($student, 1);
        $student->music = $this->getScore($student, 2);
        $student->english = $this->getScore($student, 3);
        $student->gpa = number_format(($student->math + $student->music + $student->english) / 3, 2);
        if ($student->gpa > 5.0) {
            $student->pass = 'Y';
        } else {
            $student->pass = 'N';
        }
    }
}
