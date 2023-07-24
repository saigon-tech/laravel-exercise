<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
