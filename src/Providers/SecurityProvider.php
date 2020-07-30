<?php


namespace App\Providers;


use Core\Interfaces\ServiceProviderInterface;
use Core\Security;
use DI\Container;

class SecurityProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'security';

    /**
     * @param Container $di
     *
     * @return void
     */
    function register(Container $di): void
    {
        $di->set($this->providerName, function() {
            return new Security();
        });
    }
}