<?php

namespace App\Http\Services;

use App\Models\Student;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentService
{
    /**
     * Get student list or searched student list
     * @param  array|null  $parameters
     * @return Builder
     */
    public function getStudentList(?array $parameters): Builder
    {
        $search = data_get($parameters, 'searchInput');
        $query = Student::query();
        return Student::scopeFindName($query, $search);
    }
}
