<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        for ($i=0;$i<50;$i++)
        {
            DB::table('students')->insert([
                'name' => Str::random(10),
                'birthday' => carbon::create('03/10/2000'),
            ]);
        }
    }
}
