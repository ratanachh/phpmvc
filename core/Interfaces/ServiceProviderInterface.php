<?php
declare(strict_types=1);

namespace Core\Interfaces;

use DI\Container;

interface ServiceProviderInterface
{
    function register(Container $di): void;
}