<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(20),
        'birthday' => $faker->dateTimeBetween('1990/01/01', '2015/01/01'),
    ];
});
