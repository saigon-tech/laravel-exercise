<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username'=>'admin',
            'password'=>Hash::make('admin'),
            'email'=>'admin@gmail.com'
        ]);
        factory(Admin::class, 100)->create();
    }
}
