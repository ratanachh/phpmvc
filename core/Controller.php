<?php
declare(strict_types=1);

namespace Core;

use Core\Interfaces\InjectableInterface;
use DI\Container;

abstract class Controller extends Application implements InjectableInterface
{

    public function setDI(Container $di)
    {
        $this->di = $di;
        $this->registerService($di);
    }

    abstract protected function registerService(Container $di);

}