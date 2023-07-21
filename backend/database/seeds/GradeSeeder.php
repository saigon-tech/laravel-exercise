<?php

use Illuminate\Database\Seeder;
use App\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grade::class, 100)->create();
    }
}
