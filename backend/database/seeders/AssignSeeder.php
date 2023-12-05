<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = \App\Models\Member::all();
        $members->each(function ($member) {
            $projects = \App\Models\Project::inRandomOrder()->take(3)->pluck('id');

            // assign member to project
            $member->projects()->sync($projects);

        });
    }
}
