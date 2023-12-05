<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = [
        'password',
    ];

    // hasMany relationship with Attendance
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // hasMany relationship with Activity
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    // belongsToMany relationship with Project
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_member')
            ->withPivot('id', 'percentage');
    }

    // belongsToMany relationship with Task
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'activities')
            ->withPivot('id', 'start', 'end', 'hours', 'description')
            ->withTimestamps();
    }
}
