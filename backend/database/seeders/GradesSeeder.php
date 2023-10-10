<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            ], [
                'student_id' => '1',
                'subject' => '3',
                'grade' => '5'
            ],
            [
                'student_id' => '2',
                'subject' => '1',
                'grade' => '10'
            ],
            [
                'student_id' => '2',
                'subject' => '3',
                'grade' => '5'
            ],

            [
                'student_id' => '3',
                'subject' => '2',
                'grade' => '1'
            ],
            [
                'student_id' => '3',
                'subject' => '1',
                'grade' => '2'
            ]
        ]);
    }
}
