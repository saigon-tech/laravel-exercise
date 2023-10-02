<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'khang.sgt@gmail.com'
            ],
            [
                'username' => 'khangnguyen',
                'password' => Hash::make('admin'),
                'email' => 'khangvip@gmail.com'
            ]
        ]);
    }
}
