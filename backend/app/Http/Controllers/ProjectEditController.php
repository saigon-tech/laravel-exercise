<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectEditService;
use Illuminate\View\View;

class ProjectEditController extends Controller
{
    /**
     * Show the edit project page.
     *
     * @param  string  $id
     * @return View
     */
    public function __invoke(string $id): View
    {
        // prepare view data by using ProjectEditService.
        $data = ProjectEditService::prepareViewData($id);

        // Return the view
        return view('projects.edit', $data);
    }
}
