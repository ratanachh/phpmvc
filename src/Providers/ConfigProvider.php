<?php
declare(strict_types=1);

namespace App\Providers;

use App\Application;
use Core\Config;

use Core\Interfaces\ServiceProviderInterface;
use DI\Container;

class ConfigProvider implements ServiceProviderInterface
{
    /**
     * @var string $providerName
     */
    protected $providerName = 'config';

    public function register(Container $di) : void
    {
        /** @var Application $application */
        $application = $di->get(Application::APPLICATION_PROVIDER);

        /** @var string $rootPath */
        $rootPath = $application->getRootPath();

        $di->set($this->providerName, function () use ($rootPath) {
            $config = require_once $rootPath . '/config/config.php';
            return new Config($config);
        });
        $di->get($this->providerName);
    }
}