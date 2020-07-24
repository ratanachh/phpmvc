<?php
declare(strict_types=1);

namespace App\Providers;

use Core\Interfaces\ServiceProviderInterface;
use Core\Session;
use DI\Container;

class SessionProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'session';

    /**
     * @param Container $di
     *
     * @return void
     */
    public function register(Container $di): void
    {
        $config = $di->get('config');
        $di->set($this->providerName, function() use ($config){
            $session = new Session($config->application->sessionSavePath);
            $session->start();

            return $session;
        });
    }

}