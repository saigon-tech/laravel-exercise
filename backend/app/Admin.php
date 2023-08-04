<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable =
        ['username', 'password', 'email',];
    protected $hidden = ['password'];
    public $timestamps = false;
}
