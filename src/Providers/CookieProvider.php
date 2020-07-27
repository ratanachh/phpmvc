<?php
declare(strict_types=1);

namespace App\Providers;

use DI\Container;
use Core\Cookie;
use Core\Interfaces\ServiceProviderInterface;

class CookieProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'cookie';

    public function register(Container $di) : void
    {
        $di->set($this->providerName, function () {
            return new Cookie();
        });
    }
}