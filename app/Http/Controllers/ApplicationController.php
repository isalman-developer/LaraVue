<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * as we are using the controller just to load the landing page and nothing more. so we just declare a single __invoke function for it.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('welcome');
    }
}
