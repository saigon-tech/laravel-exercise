<?php

namespace App\Http\Services;

use App\Enums\GradeSubjectEnum;
use App\Student;

class StudentService
{
    public function getList($parameters)
    {
        $sortBy = data_get($parameters, 'field', 'id');
        $order = data_get($parameters, 'order', 'asc');
        $keyword = data_get($parameters, 'keyword', '');
        $query = Student::with('grades');
        if ($keyword) {
            $query = $query->where('name', 'like', "%$keyword%");
        }
        return $query->orderBy($sortBy, $order)->paginate(10);
    }

    public function store($parameters)
    {
        $student = Student::create($parameters);
        $grades = $this->mapGradeValue($parameters);
        $student->grades()->createMany($grades);
    }


    public function update(Student $student, array $parameters)
    {
        $student->update($parameters);
        $gradeParameters = $this->mapGradeValue($parameters);
        foreach ($student->grades as $key => $grade) {
            $grade->update($gradeParameters[$key]);
        }
    }

    private function mapGradeValue(array $parameters): array
    {
        return collect(GradeSubjectEnum::asArray())
            ->map(function ($subject, $key) use ($parameters) {
                return [
                    'subject' => $subject,
                    'grade' => data_get($parameters, strtolower($key)),
                ];
            })
            ->values()
            ->toArray();
    }
}
