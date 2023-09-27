<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        function insertGradesSeeder($id, $sub, $grade):void {
            DB::table('grades')->insert([
                'student_id' => $id,
                'subject' => $sub,
                'grade' => $grade
            ]);
        }

        Schema::disableForeignKeyConstraints();
        DB::table('grades')->truncate();
        Schema::enableForeignKeyConstraints();

        insertGradesSeeder(1, 1, 7);
        insertGradesSeeder(2, 2, 9);
        insertGradesSeeder(3, 3, 5);
    }
}
