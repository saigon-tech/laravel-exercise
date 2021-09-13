<?php

namespace App\Http\Controllers;

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
        //Get query
        $search = $request->query('search');
        $col = $request->query('col');
        $orders[$col] = $request->query('order');

        //Get all students
        $students = Student::all();
        $students->each(function ($item, $itemKey) {
            //Add score column each subject
            $this->extracted($item);
        });

        //Search
        if (empty($search) != true) {
            $students->each(function ($item, $itemKey) use ($search, $students) {
                if (strpos(strtoupper($item->name), strtoupper($search)) <= -1) {
                    unset($students[$itemKey]);
                }
            });
        }

        //Sort column
        if (empty($col) != true) {
            if ($orders[$col] == 'down') {
                $students = $students->sortBy($col)->toArray();
                $status = '8595';
                $orders[$col] = 'up';
            } else {
                $students = $students->sortByDesc($col)->toArray();
                $status = '8593';
                $orders[$col] = 'down';
            }
        } else {
            $students = $students->toArray();
            $status = null;
            $orders[$col] = null;
        }

        //Convert an array to pagination
        $students = $this->getStudents($students);

        $admin = Auth::user()->username;
        return view('student.index')
            ->with('admin', $admin)
            ->with('students', $students)
            ->with('search', $search)
            ->with('col', $col)
            ->with('orders', $orders)
            ->with('status', $status);
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
        //Get query
        $validated = $request->only('name', 'birthday', 'math', 'music', 'english');

        DB::beginTransaction();
        //Create student and grade
        try {
            $student = Student::create([
                'name' => $validated['name'],
                'birthday' => $validated['birthday'],
            ]);

            $gradeSubject1 = Grade::create([
                'student_id' => $student['id'],
                'subject' => 1,
                'grade' => $validated['math'],
            ]);
            $gradeSubject2 = Grade::create([
                'student_id' => $student['id'],
                'subject' => 2,
                'grade' => $validated['music'],
            ]);
            $gradeSubject3 = Grade::create([
                'student_id' => $student['id'],
                'subject' => 3,
                'grade' => $validated['english'],
            ]);
            if ($student and $gradeSubject1 and $gradeSubject2 and $gradeSubject3) {
                DB::commit();
                return redirect()->route('student.index')->with('msg', __('student.message_add_success'));
            } else {
                DB::rollBack();
                return redirect()->route('student.index')->with('msg', __('student.message_add_fail'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('student.index')->with('msg', __('student.message_add_fail'));
        }
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

        //Add score column each subject
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
        DB::beginTransaction();
        try {
            $student = Student::where('id', $id)->first();
            $student->name = $validated['name'];
            $student->birthday = $validated['birthday'];
            if ($student->save()) {
                $grade = Grade::where('student_id', $id)->where('subject', 1)->firstOrFail();
                $grade->grade = $validated['math'];
                $grade->save();
                $grade = Grade::where('student_id', $id)->where('subject', 2)->firstOrFail();
                $grade->grade = $validated['music'];
                $grade->save();
                $grade = Grade::where('student_id', $id)->where('subject', 3)->firstOrFail();
                $grade->grade = $validated['english'];
                $grade->save();
                DB::commit();
                return redirect()->route('student.index')->with('msg', __('student.message_update_success'));
            } else {
                DB::rollBack();
                return redirect()->route('student.index')->with('msg', __('student.message_update_fail'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('student.index')->with('msg', __('student.message_update_fail'));
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
        $student->gpa = number_format(($student->math + $student->music + $student->english) / 3, 1);
        ($student->gpa > 5.0) ? $student->pass = 'Y' : $student->pass = 'N';
    }

    /**
     * @param array $students
     * @return LengthAwarePaginator
     */
    public function getStudents(array $students): LengthAwarePaginator
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage($pageName = 'page', $default = 1);
        $perPage = 10;
        $currentItems = array_slice($students, $perPage * ($currentPage - 1), $perPage);
        $students = (new LengthAwarePaginator($currentItems, count($students), $perPage, $currentPage))
            ->setPath(route(Route::currentRouteName()));
        $students->each(function ($item, $itemKey) use ($students) {
            $students[$itemKey] = (object)$item;
        });
        return $students;
    }
}
