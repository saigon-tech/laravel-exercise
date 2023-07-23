<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'birthday',
    ];

    public $timestamps = false;

    public function grades()
    {
        return $this->hasMany(Grade::class,'student_id','id');
    }
}
