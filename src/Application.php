<?php

namespace App;

use DI\Container;
use Core\Application as MvcApplication;
use Exception;

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
        try {
            $this->initializeProviders();
            $this->_set_reporting();
            $this->_unregister_globals();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Run Application
     *
     * @return string
     * @throws Exception
     */
    public function run(): string
    {
        try {
            $response = $this->app->handle(BASE_URI);
            return (string) $response->getContent();
        } catch (Exception $exception){
            echo $exception->getMessage();
        }
        return '';
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
            throw new Exception('File providers.php does not exist or is not readable.');
        }

        $providers = require_once $filename;

        foreach ($providers as $providerClass) {
            $provider = new $providerClass;
            $provider->register($this->di);
        }

    }//end initializeProviders()

    private function _set_reporting()
    {
        if (getenv('APP_DEBUG'))
        {
            error_reporting(E_ALL);
            ini_set('display_errors', "1");
        }
        else
        {
            $logPath = $this->di->get('config')->logger->path;
            error_reporting(0);
            ini_set('display_errors', "1");
            ini_set('log_errors', "1");
            ini_set('error_log', $logPath. 'errors.log');
        }
    }

    private function _unregister_globals()
    {
        if (ini_get('register_globals'))
        {
            $global_arr = ['_SESSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach ($global_arr as $key => $value)
            {
                if ($GLOBALS[$key] === $value)
                {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}