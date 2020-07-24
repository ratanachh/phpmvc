<?php
declare(strict_types=1);

namespace Core;

use DI\Container;

use function App\dd;

class Router
{

    /**
     * @var Container $di
     */
    protected $di;

    /**
     * @var Request $_request
     */
    protected $_request;

    /**
     * @var array $_getHandler
     */
    protected $_getHandler = [];

    /**
     * @var array $_postHandler
     */
    protected $_postHandler = [];

    /**
     * @var array $_putHandler
     */
    protected $_putHandler = [];

    /**
     * @var array $_deleteHandler
     */
    protected $_deleteHandler = [];

    public function __construct()
    {
        try{
            $this->_request = new Request();
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
        $level =  count(array_diff(explode('/', $pattern), [''])); // Clean empty string from array
        $this->{"_$name" . "Handler"}[$level][$pattern] =  array_shift($params);
    }

    public function handle($url)
    {
        try{
            $method = strtolower($this->_request->getMethod());

            $resolver = new UrlResolver($url);
            $resolver->setData($this->{"_$method" . "Handler"});
            $resolver->resolve();
        } catch(\Exception $e) {
            die ($e->getMessage());
        }
    }

}