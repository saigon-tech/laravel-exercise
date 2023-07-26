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
            'username'=>'vinh',
            'password'=> Hash::make('123bonnamsau@@'),
            'email'=>'vinh.hc@gmail.com'
        ]);
    }
}
