<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grade;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;


$factory->define(Grade::class, function (Faker $faker) {
    return [
        'student_id' => $faker->numberBetween(0, 100),
        'subject' => Arr::random(['math', 'music', 'english']),
        'grade' => $faker->numberBetween(0, 10)
    ];
});
