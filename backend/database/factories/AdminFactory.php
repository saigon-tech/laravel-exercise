<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->username(),
        'password' => Hash::make('123456'),
        'email' => str::random(6) . '@gmail.com'
    ];
});
