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
    public function grades() {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
}
