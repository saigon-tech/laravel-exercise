<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'id',
        'student_id',
        'subject',
        'grade',
    ];

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
