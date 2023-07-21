<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'id',
        'username',
        'password',
        'email',
    ];

    protected $hidden = ['password'];

    public $timestamps = false;
}
