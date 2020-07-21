<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id', 'name', 'birthday',
    ];
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function subjects()
    {
        return $this->hasMany('App\Grade');
    }
}
