<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grade;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'grade' => $faker->numberBetween(0, 10),
    ];
});
