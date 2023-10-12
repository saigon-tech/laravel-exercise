<?php

namespace App\Http\Controllers;

use App\Enums\GradeSubjectEnum;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentListRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Services\StudentService;
use App\Models\Student;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct()
    {
        $this->studentService = resolve(StudentService::class);
    }

    /**
     * Display student's list page.
     * @param  StudentListRequest  $request
     * @return View
     */
    public function index(StudentListRequest $request): View
    {
        $parameters = $request->validated();
        $subjects = GradeSubjectEnum::asArray();
        $limit = config('constant.pagination_per_page');
        $students = $this->studentService->getStudentList($parameters)
            ->paginate($limit);

        $links = $students->appends([
            'searchInput' => data_get($parameters, 'searchInput'),
            'page' => data_get($parameters, 'page'),
            'limit' => data_get($parameters, 'limit'),
        ]);
        return view('student.list', compact('students', 'subjects', 'links'));
    }

    /**
     * Display specific student's detail page
     * @param  Student|null  $student
     * @return View
     */
    public function getDetail(?Student $student): View
    {
        $subjects = GradeSubjectEnum::asArray();
        return view('student.detail', compact('student', 'subjects'));
    }

    /**
     * Display student detail with no input to create new student.
     * @return View
     */
    public function getCreate(): View
    {
        $subjects = GradeSubjectEnum::asArray();
        $student = null;
        return view('student.detail', compact('student', 'subjects'));
    }

    /**
     * Update student's information
     * @param  StudentUpdateRequest  $request
     * @param  Student  $student
     * @return RedirectResponse
     * @throws InvalidEnumMemberException
     */
    public function update(StudentUpdateRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->all());
        $grades = $student->grades
            ->map(function ($grade) use ($request) {
                $point = data_get($request->all(), 'grades');
                $grade->grade = data_get($point, GradeSubjectEnum::getKey("{$grade->subject}"));
                return $grade;
            })
            ->toArray();
        $student->grades()->upsert($grades, ['id'], ['grade']);
        return redirect()->route('student.list');
    }

    /**
     * Store new student
     * @param  StudentCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(StudentCreateRequest $request): RedirectResponse
    {
        $student = new Student($request->all());
        $student->save();
        $grades = collect($request->get('grades'))
            ->map(function ($grade, $subject) {
                return [
                    'subject' => GradeSubjectEnum::getValue($subject),
                    'grade' => $grade,
                ];
            })->toArray();
        $student->grades()->createMany($grades);
        return redirect()->route('student.list');
    }
}
