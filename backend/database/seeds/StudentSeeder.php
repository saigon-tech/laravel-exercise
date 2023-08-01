<?php

use App\Grade;
use App\Student;
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
        factory(Student::class, 100)->create()->each(function ($student) {
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 1]);
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 2]);
            factory(Grade::class)->create(['student_id' => $student->id, 'subject' => 3]);
        });
    }
}
