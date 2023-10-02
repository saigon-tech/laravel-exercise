<?php

namespace App\Models;

use App\Models\User as Authenticate;

class Admin extends Authenticate
{
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];

}
