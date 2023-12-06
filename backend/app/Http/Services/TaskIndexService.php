<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskIndexService
{
    /**
     * Prepare view data for the index page of the task list.
     *
     * @return array<string, mixed>
     */
    public static function prepareViewData(?string $keyword): array
    {
        // Get all tasks by searching by the keyword, pagination with query string, and sorting.
        $tasks = Task::search($keyword)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Return the view data.
        return [
            'tasks' => $tasks,
        ];
    }
}
