<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    do {
        $name = $faker->firstName . ' ' . $faker->lastName;
    } while(strlen($name)>20);

    return [
        'name' => $name,
        'birthday' => $faker->dateTimeBetween('1990-01-01', '2015-01-01')->format('Y-m-d'),
    ];
});
