<?php

namespace App\Controllers;

class HomeController extends ControllerBase
{
    public function index()
    {
        $this->session->t = 'test';

        $this->session->t = null;
        var_dump(microtime(true) - START_TIME);
    }
}