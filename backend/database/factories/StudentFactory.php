<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => substr($faker->firstName . ' ' . $faker->lastName,0, 20),
        'birthday' => $faker->dateTimeBetween('1990-01-01','2015-01-01')->format('Y-m-d'),
    ];
});
