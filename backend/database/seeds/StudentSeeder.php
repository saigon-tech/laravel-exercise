<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name'=>'thanh',
            'birthday'=>'1999-07-11',
        ]);
        DB::table('students')->insert([
            'name'=>'hong',
            'birthday'=>'1999-04-09',
        ]);
    }
}
