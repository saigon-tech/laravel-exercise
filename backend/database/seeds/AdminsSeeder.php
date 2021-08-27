<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => Str::random(10),
            'password' => Hash::make('password'),
            'email' =>  Str::random(10).'@gmail.com'
        ]);
    }
}
