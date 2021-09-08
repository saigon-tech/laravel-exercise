<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;

/**
 * Class WelcomeController
 */
class WelcomeController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('student.index');
    }
}
