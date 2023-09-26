<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            'name' => 'Nhan',
            'birthday' => '2000/01/01',
        ]);

        DB::table('students')->insert([
            'name' => 'Van Hau',
            'birthday' => '1993/01/01',
        ]);

        DB::table('students')->insert([
            'name' => 'Van Toan',
            'birthday' => '1995/01/01',
        ]);
    }
}
