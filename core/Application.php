<?php
declare(strict_types=1);

namespace Core;

use DI\Container;


class Application
{

    public function __construct(Container $di)
    {
        echo 'Mvc app</br>';

    }

    public function handle(string $url)
    {
        # code...
    }

}