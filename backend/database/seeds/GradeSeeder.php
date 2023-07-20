<?php

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'student_id'=>465,
            'subject'=>'English',
            'grade'=>9
        ]);
    }
}
