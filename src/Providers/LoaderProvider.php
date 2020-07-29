<?php
declare(strict_types=1);

namespace App\Providers;

use Core\Interfaces\ServiceProviderInterface;
use DI\{
    Container,
    DependencyException,
    NotFoundException
};

use Core\Loader;

class LoaderProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'loader';

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

        $di->set($this->providerName, function() use ($config){
            $loader = new Loader();
            // Register namespaces
            $loader->registerNamespaces([
                'App\Controllers' => $config->application->controllersDir,
                'App\Model'           => $config->application->modelsDir,
            ]);

            $loader->register();
            return $loader;
        });

    }
}