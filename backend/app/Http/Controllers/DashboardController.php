<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Show the dashboard
    public function __invoke()
    {
        return view('dashboard');
    }
}
