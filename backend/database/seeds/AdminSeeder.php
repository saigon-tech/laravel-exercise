<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email' => str::random(10) . '@gmail.com',
        ]);
    }
}
