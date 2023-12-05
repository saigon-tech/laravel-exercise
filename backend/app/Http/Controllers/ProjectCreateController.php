<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectCreateController extends Controller
{
    /**
     * Show the create project page.
     *
     * @return View
     */
    public function __invoke(): View
    {
        // Return the view
        return view('projects.create');
    }
}
