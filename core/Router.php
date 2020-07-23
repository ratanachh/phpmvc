<?php
declare(strict_types=1);

namespace Core;

use DI\Container;

class Router
{

    /**
     * @var Container $di
     */
    protected $di;

    public function __construct()
    {
        echo 'Mvc route</br>';
    }

    public function setDI(Container $di)
    {
        $this->di = $di;
    }

    

}