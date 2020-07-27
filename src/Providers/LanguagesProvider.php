<?php
declare(strict_types=1);

namespace App\Providers;

use Core\Interfaces\ServiceProviderInterface;
use Core\Locale;
use DI\Container;

class LanguageProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'lang';

    /**
     * @param Container $di
     *
     * @return void
     */
    public function register(Container $di): void
    {
        $config = $di->get('config');

        $di->set($this->providerName, function() use ($config){
            return new Locale($config->);
        });
    }

}