<?php
declare(strict_types=1);

namespace Core;

use Core\Interfaces\InjectableInterface;
use DI\Container;

use Core\Utils\Helper;

class Router implements InjectableInterface
{

    /**
     * @var Container $di
     */
    protected $di;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var array $getHandler
     */
    protected $getHandler = [];

    /**
     * @var array $postHandler
     */
    protected $postHandler = [];

    /**
     * @var array $putHandler
     */
    protected $putHandler = [];

    /**
     * @var array $deleteHandler
     */
    protected $deleteHandler = [];

    /**
     * @var string $routeSeparator
     */
    protected $routeSeparator = '/';

    public function __construct()
    {
        try{
            $this->request = new Request();
        }catch(\Exception $e) {
            die ($e->getMessage());
        }
    }

    public function setDI(Container $di)
    {
        $this->di = $di;
    }

    public function __call($name, $params)
    {
        $pattern = array_shift($params);
        $level =  count(Helper::cleanEmptyValueArray(explode($this->routeSeparator, $pattern)));
        $this->{"$name" . "Handler"}[$level][$pattern] =  array_shift($params);
    }

    public function handle($url)
    {
        $method = strtolower($this->request->getMethod());
        $resolver = new UrlResolver($url);
        $resolver->setDI($this->di);
        $resolver->setData($this->{"$method" . "Handler"});
        $resolver->setRouteSeparator($this->routeSeparator);
        $call = $resolver->resolve();
        if (count($call) === 0 ){
            throw new \Exception("Not found");
        }
        call_user_func_array(...$call);
    }

}