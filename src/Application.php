<?php

namespace App;

use DI\Container;
use Core\Application as MvcApplication;
use Core\Interfaces\ResponseInterface;

class Application
{

    const APPLICATION_PROVIDER = 'bootstrap';

    /**
     * @var MvcApplication
     */
    protected $app;

    protected $di;

    /**
     * Project root path
     *
     * @var string
     */
    protected $rootPath;

    public function __construct(string $rootPath)
    {
        $this->di = new Container();
        $this->app      = $this->createApplication();
        $this->rootPath = $rootPath;

        $this->di->set(self::APPLICATION_PROVIDER, $this);
        $this->initializeProviders();
    }

    /**
     * Run Application
     *
     * @return string
     * @throws Exception
     */
    public function run(): string
    {
        /**
         * @var ResponseInterface $response
         */
        // $response = $this->app->handle(BASE_URI);

        // return (string) $response->getContent();
        return "";

    }//end run()

    /**
     * Get Project root path
     *
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }//end getRootPath()

    /**
     * @return MvcApplication
     */
    protected function createApplication(): MvcApplication
    {
        return new MvcApplication($this->di);

    }//end createApplication()

    /**
     * @throws Exception
     */
    protected function initializeProviders(): void
    {
        $filename = $this->rootPath.'/config/providers.php';

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \Exception('File providers.php does not exist or is not readable.');
        }

        $providers = require_once $filename;

        foreach ($providers as $providerClass) {
            /**
            @var ServiceProviderInterface $provider
             */
            $provider = new $providerClass;
            $provider->register($this->di);
        }

    }//end initializeProviders()
}