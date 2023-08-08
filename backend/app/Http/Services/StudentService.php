<?php

namespace App\Http\Services;

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
}
