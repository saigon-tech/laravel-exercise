<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SeedStudents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => str::random(10),
            'date' => Carbon::create('2000', '01', '01'),
        ]);
        DB::table('grades')->insert([
            ['students_id'=>'1',
            'subject' => '2',
            'grade' => '9'],
        ]);
    }
}
