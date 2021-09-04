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
    public function Student() {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }
}
