<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /**
     * @return HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }

    protected $dateFormat = 'Y/m/d';
    /**
     * Take the grade of the specific subject
     * @param  string  $gradeSubjectEnum
     * @return int
     */
    public function getGrade(string $gradeSubjectEnum): int
    {
        return $this->grades()->where('subject', 'like', $gradeSubjectEnum)->first()?->grade;
    }
    /**
     * Get
     * @return Attribute
     */
    protected function gradeAvg(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->grades->avg('grade'), 1),
        );
    }
    /**
     * get the pass/fail base on GPA
     * @return string
     */
    public function check_pass(): string
    {
        $avgGrade = $this->grades()->avg('grade');
        if ($avgGrade > 5) {
            return trans('auth.gpa_pass');
        } else {
            return trans('auth.gpa_fail');
        }
    }
}
