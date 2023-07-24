<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grade;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;


$factory->define(Grade::class, function (Faker $faker) {
    return [
        'grade' => $faker->numberBetween(0, 10)
    ];
});
