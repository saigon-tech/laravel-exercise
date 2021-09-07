<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) use ($factory) {
    return [
        'grade' => random_int(1,10),
    ];
});
