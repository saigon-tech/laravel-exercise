<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

//use Illuminate\Database\Eloquent\Model;
use App\Models\User as Authenticate;

class Admins extends Authenticate
{
    use HasFactory;
    protected $table = 'admins';
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];
}
