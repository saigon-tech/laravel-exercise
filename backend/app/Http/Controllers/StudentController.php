<?php

namespace App\Http\Controllers;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Student\StoreRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

/**
 * Class StudentController
 */
class StudentController extends Controller
{
    /**
     * @param $student
     * @param $subject
     * @return mixed
     */
    public function getScore($student, $subject)
    {
        $score = DB::table('students')
            ->Join('grades', 'students.id', '=', 'grades.student_id')
            ->select('grades.subject', 'grades.grade')
            ->where('grades.student_id', '=', $student->id)
            ->where('grades.subject', '=', $subject)
            ->first();
        return $score->grade;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $col = $request->query('col');

        $students = Student::all();
        $students->each(function ($item, $itemKey) {
            $this->extracted($item);
        });

        if(empty($search)!=true){
            $students->each(function ($item, $itemKey) use ($search, $students) {
                if (strpos(strtoupper($item->name), strtoupper($search)) <= -1) {
                    unset($students[$itemKey]);
                }
            });
        }
        if(empty($col)!=true) {
            $students = $students->sortBy($col)->toArray();
        } else {
            $students = $students->toArray();
        }

        $students = $this->getStudents($students); //convert to paginate
        $admin = Auth::user()->username;
        return view('student.student')
            ->with('admin', $admin)
            ->with('students', $students)
            ->with('search', $search)
            ->with('col', $col);
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('col');
        if ($search != '') {
            $students = Student::all();
            $students = ($students->each(function ($item, $itemKey) use ($search, $students) {
                if (strpos(strtoupper($item->name), strtoupper($search)) > -1) {
                    $this->extracted($item);
                } else {
                    unset($students[$itemKey]);
                }
            }));
            if ($sort != '') {
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
        return view('student.student')->with('admin', $admin)
            ->with('students', $students)
            ->with('path', $path)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $admin = Auth::user()->username;
        return view('student.create')->with('admin', $admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->only('name', 'birthday', 'math', 'music', 'english');

        $student = Student::create([
            'name' => $validated['name'],
            'birthday' => $validated['birthday'],
        ]);

        Grade::create([
            'student_id' => $student['id'],
            'subject' => 1,
            'grade' => $validated['math'],
        ]);
        Grade::create([
            'student_id' => $student['id'],
            'subject' => 2,
            'grade' => $validated['music'],
        ]);
        Grade::create([
            'student_id' => $student['id'],
            'subject' => 3,
            'grade' => $validated['english'],
        ]);

        return redirect()->route('student.index')->with('msg', 'Student was added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $student = Student::where('id', '=', $id)->firstorfail();
        $this->extracted($student);
        $admin = Auth::user()->username;
        return view('student.edit')
            ->with('admin', $admin)
            ->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreRequest $request, int $id): RedirectResponse
    {
        $validated = $request->only('name', 'birthday', 'math', 'music', 'english');

        $student = Student::where('id', $id)->first();
        $student->name = $validated['name'];
        $student->birthday = $validated['birthday'];
        if ($student->save()) {
            $grade = Grade::find($id);
            $grade = Grade::where('student_id', $id)->where('subject', 1)->firstOrFail();
            $grade->grade = $validated['math'];
            $grade->save();
            $grade = Grade::where('student_id', $id)->where('subject', 2)->firstOrFail();
            $grade->grade = $validated['music'];
            $grade->save();
            $grade = Grade::where('student_id', $id)->where('subject', 3)->firstOrFail();
            $grade->grade = $validated['english'];
            $grade->save();
            return redirect()->route('student.index')->with('msg', 'Student was updated!');
        } else {
            return redirect()->route('student.index')->with('msg', 'Student was not update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        //
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
