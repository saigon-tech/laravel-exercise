<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = \App\Models\Task::all()->pluck('id');
        $members = \App\Models\Member::all();
        $members->each(function ($member) use ($tasks) {
            $projects = \App\Models\Project::inRandomOrder()->take(3)->pluck('id');

            // go through each day for the last 30 days
            for ($i = 0; $i < 30; $i++) {
                // go through each project
                $projects->each(function ($project) use ($member, $tasks, $i) {
                    // go through each task
                    $tasks->each(function ($task) use ($member, $project, $i) {
                        // create an activity
                        \App\Models\Activity::factory()->create([
                            'member_id' => $member->id,
                            'project_id' => $project,
                            'task_id' => $task,
                            'date' => now()->subDays($i)->format('Y-m-d'),
                        ]);
                    });
                });
            }

        });
    }
}
