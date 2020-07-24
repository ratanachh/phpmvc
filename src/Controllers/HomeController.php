<?php

namespace App\Controllers;

class HomeController extends ControllerBase
{
    public function index()
    {
        var_dump(microtime(true) - START_TIME);
    }
}