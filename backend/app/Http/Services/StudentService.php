<?php

namespace App\Http\Services;

use App\Student;

class StudentService
{
    public function getList($parameters)
    {
        $sortBy = data_get($parameters, 'sort_by', 'id');
        $order = data_get($parameters, 'sort_order', 'asc');
        $keyword = data_get($parameters, 'keyword', '');
        $query = Student::query();
        if ($keyword) {
            $query = $query->where('name', 'like', "%$keyword%");
        }
        return $query->orderBy($sortBy, $order)->paginate(10);
    }

    private function queryParameters($query)
    {

    }
}
