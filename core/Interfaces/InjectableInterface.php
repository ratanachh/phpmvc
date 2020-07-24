<?php
declare(strict_types=1);

namespace Core\Interfaces;

use DI\Container;

interface InjectableInterface
{
    function setDI(Container $di);
}