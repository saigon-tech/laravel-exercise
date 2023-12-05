<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectShowService
{
    // prepare data for the view
    public static function prepareViewData($id): array
    {
        // get the project
        $project = Project::findOrFail($id);

        // load the members of the project
        $project->load('members');

        // return the data
        return compact('project');
    }

}
