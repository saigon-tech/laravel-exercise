<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeders.
     */

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            AdminsSeeder::class,
            GradesSeeder::class,
            StudentsSeeder::class
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
