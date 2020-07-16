<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
