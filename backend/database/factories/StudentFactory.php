<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'birthday' => $faker->dateTimeBetween('1990-01-01','2015-01-01')->format('Y-m-d'),
    ];
});
