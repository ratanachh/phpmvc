<?php

namespace App\Controllers;

class HomeController extends ControllerBase
{
    public function index()
    {
        $this->session->t = 'test';
        var_dump(microtime(true) - START_TIME);
    }

    public function index34($value, $value2)
    {
        echo $value. ' '. $value2;
    }
}