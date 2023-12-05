<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectShowService;
use Illuminate\View\View;

class ProjectShowController extends Controller
{
    /**
     * Show the page of the project detail.
     *
     * @param $id
     * @return View
     */
    public function __invoke($id): View
    {
        // Prepare view data by using ProjectShowService.
        $data = ProjectShowService::prepareViewData($id);

        // Return the view, passing the data.
        return view('projects.show', $data);
    }
}
