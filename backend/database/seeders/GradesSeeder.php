<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('grades')->truncate();
        Schema::enableForeignKeyConstraints();

        Grade::factory(10)->create();
    }
}
