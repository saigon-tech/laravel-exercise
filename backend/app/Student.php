<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'birthday',
    ];

    public $timestamps = false;

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}
