<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectUpdateService
{

    public static function update(array $updateData, string $id)
    {
        // Find the project by id
        $project = Project::findOrFail($id);

        // Update the project
        $project->update($updateData);
    }
}
