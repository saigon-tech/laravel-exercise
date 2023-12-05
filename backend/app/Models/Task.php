<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 *
 * @package App\Models
 * @see Model
 */
class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
}
