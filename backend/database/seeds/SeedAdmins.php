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
        DB::table('admin')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email' => str::random(10).'@gmail.com',
        ]);
    }
}
