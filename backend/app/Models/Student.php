<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'birthday'
    ];
    public function Grade() {
        return $this->hasMany('App\Models\Grade', 'student_id', 'id');
    }
}
