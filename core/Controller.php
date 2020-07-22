<?php
declare(strict_types=1);

namespace Core;

use DI\Container;


class Controller
{

    public function __construct(Container $di)
    {
        echo 'Mvc Controller</br>';

    }

}