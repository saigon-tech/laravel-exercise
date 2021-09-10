<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View as ViewAlias;

/**
 * Class WelcomeController
 */
class WelcomeController extends Controller
{
    /**
     * @return Application|Factory|ViewAlias
     */
    public function index()
    {
        return view('welcome');
    }
}
