<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'start',
        'end',
        'status',
    ];

    // belongs to many members
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'project_member')
            ->withPivot('id', 'percentage');
    }

    // scopes search by keyword in name and description
    public function scopeSearch($query, ?string $keyword): void
    {
        // if keyword is empty, do nothing
        if (empty($keyword)) {
            return;
        }
        // if keyword is not empty, search by keyword in name and description
        $query->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$keyword.'%');
        });
    }
}
