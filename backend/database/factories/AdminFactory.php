<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(Admin::class, function (Faker $faker) {
    $username = $faker->unique()->username();
    if (strlen($username) > 20) {
        $username = substr($username, 0, 20);
    }

    return [
        'username' => $username,
        'password' => Hash::make('123456'),
        'email' => str::random(6) . '@gmail.com'
    ];
});
