<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectStoreService
{
    // Store the new project into the database from the request data.
    public static function store(array $data): void
    {
        // Insert the new project into the database.
        $project = new Project($data);

        // Save the project.
        $project->save();
    }
}
