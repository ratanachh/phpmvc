<?php

namespace App\Controllers;

class HomeController extends ControllerBase
{
    public function index()
    {
        $this->session->t = 'test';

        var_dump(microtime(true) - START_TIME);
    }
}