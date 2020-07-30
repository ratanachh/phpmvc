<?php
declare(strict_types=1);

namespace Core;

use Core\Interfaces\InjectableInterface;
use DI\Container;

class Locale implements InjectableInterface
{
    protected $defaultLocalization = 'en';
    protected $dirPath;
    protected $di;
    protected $session;

    public function __construct($dirPath)
    {
        $this->dirPath = $dirPath;
    }

    public function get($key)
    {
        $this->loadConfiguration($key);

    }

    public function translate($key, ...$values)
    {
        $this->loadConfiguration($key);
        # code...
    }

    /**
     * @param Container $di
     */
    public function setDI(Container $di)
    {
        $this->di = $di;
    }

    public function loadConfiguration($key)
    {
        $sessionLanguage = $this->session->get('language') ?? $this->defaultLocalization;
        $file = explode('.', $key);
        $translateText = require_once $this->dirPath . $sessionLanguage . DIRECTORY_SEPARATOR . $file[0] . pathinfo(__FILE__, PATHINFO_EXTENSION);
        //var_dump($translateText);
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @param string $defaultLocalization
     */
    public function setDefaultLocalization(string $defaultLocalization): void
    {
        $this->session->set('language', $defaultLocalization);
    }

    /**
     * @return string
     */
    public function getDefaultLocalization(): string
    {
        return $this->session->get('language');
    }
}