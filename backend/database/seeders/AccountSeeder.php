<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $accounts = [
            ["username"=>'admin','password'=>'admin','email'=>'admin@gmail.com','type'=>1]
        ];
        DB::table('accounts')->insert($accounts);
    }
}
