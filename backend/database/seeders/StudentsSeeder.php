<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->truncate();
        DB::table('grades')->truncate();

        Student::factory(10)->has(Grade::factory(3))->create();
    }
}
