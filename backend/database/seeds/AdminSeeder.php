<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\Auth::
        factory(Admin::class, 100)->create();
    }
}
