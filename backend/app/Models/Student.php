<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'birthday'
    ];
//    public function admins() {
//        return $this->belongsTo('App\Models\Admin');
//    }
}
