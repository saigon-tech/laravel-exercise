<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectIndexService
{
    /**
     * Prepare view data for the index page of the project list.
     *
     * @return array<string, mixed>
     */
    public static function prepareViewData(?string $keyword): array
    {
        // Get all projects by searching by the keyword, pagination with query string, and sorting.
        $projects = Project::search($keyword)
            ->with('members')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Return the view data.
        return [
            'projects' => $projects,
        ];
    }
}
