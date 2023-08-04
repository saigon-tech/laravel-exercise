<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'birthday',
    ];

    public $timestamps = false;

    public function grade()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}
