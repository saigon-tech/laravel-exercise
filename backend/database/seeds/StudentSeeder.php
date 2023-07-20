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
       DB::table('Students')->insert([
           'name'=>'VinhHoang',
           'birthday'=>'09/11/1997'
       ]);
    }
}
