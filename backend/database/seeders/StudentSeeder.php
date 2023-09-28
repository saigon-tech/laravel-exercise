<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            'name' => 'Nguyen Van A',
            'birthday' => '2000/02/14'
        ]);
        DB::table('students')->insert([
            'name' => 'Nguyen Van B',
            'birthday' => '2000/02/13',
        ]);
        DB::table('students')->insert([
            'name' => 'Le Thi C',
            'birthday' => '2000/04/14',
        ]);
    }
}
