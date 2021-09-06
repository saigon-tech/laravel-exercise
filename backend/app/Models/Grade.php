<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'subject',
        'grade',
    ];
    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
