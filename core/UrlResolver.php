<?php
declare(strict_types=1);

namespace Core;

use Core\Interfaces\InjectableInterface;
use Core\Utils\Helper;
use DI\Container;

class UrlResolver implements InjectableInterface
{
    /**
     * @var Container $di
     */
    protected $di;
    protected $handler = [];
    protected $url;
    protected $defaultController = 'home';
    protected $defaultAction = 'index';
    protected $routeSeparator = '/';

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setData(array $handler)
    {
        $this->handler = $handler;
    }

    public function setDI(Container $di)
    {
        $this->di = $di;
    }

    public function resolve()
    {
        $urlArray = array_values(Helper::cleanEmptyValueArray(explode($this->routeSeparator, $this->url)));
        $level =  count($urlArray);
        if (!isset($this->handler[$level])) throw new \Exception("Not Found.", 1);
        
        $found = [];
        foreach ($this->handler[$level] as $pattern => $route) {
            $controller = $this->defaultController;
            $action = $this->defaultAction;
            $params = [];
            if (!is_callable($route) && strpos($route, '@')) {
                $ex = explode('@', $route);
                $controller = $ex [0];
                $action = $ex [1];
            }

            if ($pattern != '/') {
                $patternArray = array_values(Helper::cleanEmptyValueArray(explode($this->routeSeparator, $pattern)));
                $match = true;
                foreach ($patternArray as $k => $val) {
                    if ($val == $urlArray[$k]) continue;
                    else if(strpos($val, '{') !== false && strrpos($val, '}') !== false ) {
                        $params[] = $urlArray[$k];
                        continue;
                    } else $match = false;
                }

                if ($match) {
                    if (is_string($route) && strpos($route, '@')) {
                        $controller = $this->di->get('loader')->getNamespace($controller);
                        if (method_exists($controller, $action)) {
                            $dispatch = new $controller();
                            $dispatch->setDI($this->di);
                            $found = [[$dispatch, $action], $params];
                        } else {
                            throw new \Exception("The method $action doesn't exist in $controller.", 1);
                        }
                    } else if (is_callable($route)) {
                        $found = [$route, $params];
                    }
                    break;
                }
            } else {
                $controller = $this->di->get('loader')->getNamespace($controller);
                $dispatch = new $controller();
                $dispatch->setDI($this->di);
                $found = [[$dispatch, $action], $params];
            }
        }
        return $found;
    }

    public function setRouteSeparator(string $routeSeparator)
    {
        $this->routeSeparator = $routeSeparator;
    }

}