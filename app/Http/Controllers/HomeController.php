<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Make a invocable controller.
     *
     * @return void
     */
    public function __invoke()
    {
        return view('home');
    }
}
