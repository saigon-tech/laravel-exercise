<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // fixed admin user
        Member::factory()->create([
            'username' => 'admin',
            'name' => 'Admin',
        ]);

        Member::factory(20)->create();
        Project::factory(100)->create();
        Task::factory(10)->create();

        $this->call([
            AssignSeeder::class,
        ]);
    }
}
