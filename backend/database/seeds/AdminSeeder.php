<?php

use Illuminate\Database\Seeder;

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
            'username'=>'thanh',
            'password'=>'123',
            'email'=>'thanh@gmail.com'
        ]);
        DB::table('admins')->insert([
            'username'=>'hong',
            'password'=>'123',
            'email'=>'hongthanh@gmail.com'
        ]);
    }
}
