<?php
declare(strict_types=1);

namespace App\Providers;

use Core\Interfaces\ServiceProviderInterface;
use Core\Router;
use DI\Container;
use App\Application;

class RouterProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'router';

    /**
     * @param Container $di
     *
     * @return void
     */
    public function register(Container $di): void
    {
        /**
         * Get application from Dependency Injection
         *
         * @var Application $application
         */
        $application = $di->get(Application::APPLICATION_PROVIDER);

        /**
         * @var string $basePath
         */
        $basePath = $application->getRootPath();

        $di->set(
            $this->providerName,
            function () use ($basePath) {
                $router = new Router();
                $routes = $basePath.'/config/routes.php';
                if (file_exists($routes) === false || is_readable($routes) === false) {
                    throw new \Exception($routes.' file does not exist or is not readable.');
                }
                echo 'ses';
                require_once $routes;

                return $router;
            }
        );
    }
}