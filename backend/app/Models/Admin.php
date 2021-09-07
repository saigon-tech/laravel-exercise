<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 *
 */
class Admin extends Authenticatable
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'email'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
