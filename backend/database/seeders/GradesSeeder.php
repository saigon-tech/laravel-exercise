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
            'student_id' => '1',
            'subject' => '1',
            'grade' => '6'
        ]);
        DB::table('grades')->insert([
            'student_id' => '2',
            'subject' => '2',
            'grade' => '8'
        ]);
        DB::table('grades')->insert([
            'student_id' => '3',
            'subject' => '3',
            'grade' => '7'
        ]);
        DB::table('grades')->insert([
            'student_id' => '1',
            'subject' => '2',
            'grade' => '9'
        ]);
    }
}
