<?php

namespace Database\Seeders;

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
        DB::table('students')->insert([
            [
                'name' => 'Nguyen Van A',
                'birthday' => '2000/02/14'
            ],[
                'name' => 'Nguyen Van B',
                'birthday' => '2000/02/13',
            ],[
                'name' => 'Le Thi C',
                'birthday' => '2000/04/14',
            ]
        ]);
    }
}
