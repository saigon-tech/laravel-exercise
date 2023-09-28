<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('grades')->truncate();
        DB::table('grades')->insert([
            [
                'student_id' => '1',
                'subject' => '1',
                'grade' => '6'
            ],
            [
                'student_id' => '2',
                'subject' => '2',
                'grade' => '8'
            ],
            [
                'student_id' => '3',
                'subject' => '3',
                'grade' => '7'
            ],
            [
                'student_id' => '1',
                'subject' => '2',
                'grade' => '9'
            ]
        ]);
    }
}
