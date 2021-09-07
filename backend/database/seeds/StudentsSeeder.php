<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Student;
use \App\Models\Grade;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Student::class, 500)->create()->each(function ($student) {
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 1]);
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 2]);
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 3]);
        });
    }
}
