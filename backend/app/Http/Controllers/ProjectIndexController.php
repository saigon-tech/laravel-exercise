<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectIndexRequest;
use App\Http\Services\ProjectIndexService;
use Illuminate\View\View;

class ProjectIndexController extends Controller
{
    /**
     * Show the index page of the project list.
     *
     * @param  ProjectIndexRequest  $request
     * @return View
     */
    public function __invoke(ProjectIndexRequest $request): View
    {
        // Prepare view data by using ProjectIndexService.
        $data = ProjectIndexService::prepareViewData($request->keyword);

        // Return the view, passing the data.
        return view('projects.index', $data);
    }
}
