<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchStudentRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

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

    public function index(Request $request)
    {
        $validated = $request->query('col');
        $students = Student::all();
        $students = $students->each(function ($item, $itemKey) {
            $this->extracted($item);
        });
        if($validated != '') {
            $students = $students->sortBy($validated)->toArray();
        } else {
            $students = $students->toArray();
        }
        //convert to paginate
        $students = $this->getStudents($students);
        $admin = Auth::user()->username;
        $path = Route::currentRouteName();
        return view('Student.students')->with('admin', $admin)
            ->with('students', $students)
            ->with('path', $path);
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

    public function search(SearchStudentRequest $request)
    {
        $search = $request->query('search');
        $sort = $request->query('col');
        if($search!='') {
            $students = Student::all();
            $students = ($students->each(function ($item, $itemKey) use($search, $students) {
                if(strpos(strtoupper($item->name), strtoupper($search)) > -1) {
                    $this->extracted($item);
                } else {
                    unset($students[$itemKey]);
                }
            }));
            if($sort != '') {
                $students = $students->sortBy($sort)->toArray();
            } else {
                $students = $students->toArray();
            }
            $students = $this->getStudents($students);
        } else {
            $students = [];
        }
        $admin = Auth::user()->username;
        $path = Route::currentRouteName();
        return view('Student.students')->with('admin', $admin)
            ->with('students', $students)
            ->with('path', $path)
            ->with('search', $search);
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

    /**
     * @param array $students
     * @return LengthAwarePaginator
     */
    public function getStudents(array $students): LengthAwarePaginator
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage($pageName = 'page', $default = 1);
        $perPage = 3;
        $currentItems = array_slice($students, $perPage * ($currentPage - 1), $perPage);
        $students = (new LengthAwarePaginator($currentItems, count($students), $perPage, $currentPage))
            ->setPath(route(Route::currentRouteName()));
        $students->each(function ($item, $itemKey) use ($students) {
            $students[$itemKey] = (object)$item;
        });
        return $students;
    }
}
