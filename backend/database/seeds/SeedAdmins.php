<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SeedAdmins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => str::random(10),
            'password' => str::random(10),
            'email' => str::random(10).'@gmail.com',
        ]);
    }
}
