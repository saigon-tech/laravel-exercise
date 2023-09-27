<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function insertStudentsSeeder($name, $bd):void {
            DB::table('students')->insert([
                'name' => $name,
                'birthday' => $bd,
            ]);
        }

        Schema::disableForeignKeyConstraints();
        DB::table('students')->truncate();
        Schema::enableForeignKeyConstraints();

        insertStudentsSeeder('Nhan', '2000/01/01');
        insertStudentsSeeder('Van Hau', '1993/01/01');
        insertStudentsSeeder('Van Toan', '1995/01/01');
    }
}
