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

//    public function student()
//    {
//        return $this->belongsTo(Student::class, 'student_id', 'id');
//    }
    public $timestamps = false;
}
