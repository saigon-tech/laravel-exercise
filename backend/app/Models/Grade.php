<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected  $fillable = ['id', 'student_id', 'subject', 'grade'];
    public $timestamps = false;
}
