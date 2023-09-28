<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected  $fillable = [
        'id', 'name', 'birthday'
    ];

    public $timestamps = false;

    public function grade()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
}
