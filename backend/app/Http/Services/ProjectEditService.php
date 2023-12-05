<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectEditService
{
    /**
     * Prepare view data for the edit project page.
     *
     * @param  string  $id
     * @return array<string, mixed>
     */
    public static function prepareViewData(string $id): array
    {
        // Get the project by the id.
        $project = Project::findOrFail($id);

        // Return the view data.
        return [
            'project' => $project,
        ];
    }
}
