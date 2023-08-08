<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'vinh',
            'password' => Hash::make('123bonnamsau@@'),
            'email' => 'vinh.hc@gmail.com'
        ]);
        factory(Admin::class, 100)->create();
    }
}
