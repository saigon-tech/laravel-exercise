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
            'username' => 'taikhoan',
            'password' => Hash::make('matkhau'),
            'email' =>  'taikhoan@gmail.com'
        ]);
    }
}
