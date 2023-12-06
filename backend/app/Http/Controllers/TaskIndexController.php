<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskIndexRequest;
use App\Http\Services\TaskIndexService;
use Illuminate\View\View;

class TaskIndexController extends Controller
{
    /**
     * Show the index page of the project list.
     *
     * @param  TaskIndexRequest  $request
     * @return View
     */
    public function __invoke(TaskIndexRequest $request): View
    {
        // Prepare view data by using ProjectIndexService.
        $data = TaskIndexService::prepareViewData($request->keyword);

        // Return the view, passing the data.
        return view('tasks.index', $data);
    }
}
