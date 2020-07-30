<?php
declare(strict_types=1);

namespace App\Providers;

use Core\Interfaces\ServiceProviderInterface;
use Core\Locale;
use DI\Container;
use DI\{
    DependencyException,
    NotFoundException
};

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
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function register(Container $di): void
    {
        $config = $di->get('config');

        $di->set($this->providerName, function() use ($di, $config){
            $localization =  new Locale($config->application->languageDir);
            $localization->setDI($di);
            return $localization;
        });
    }

}