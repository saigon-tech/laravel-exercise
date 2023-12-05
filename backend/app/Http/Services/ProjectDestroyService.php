<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectDestroyService
{
    // Destroy a project.
    public static function destroy(string $id): void
    {
        // Find the project by id
        $project = Project::findOrFail($id);

        // Delete the project
        $project->delete();
    }
}
