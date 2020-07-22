<?php

namespace Core\Interfaces;

use DI\Container;

interface ServiceProviderInterface
{
    function register(Container $di): void;
}