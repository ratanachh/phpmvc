<?php
declare(strict_types=1);

namespace Core;

use function App\dd;

class UrlResolver
{
    protected $_pattern;
    protected $_class;
    protected $_action;
    protected $_params;
    protected $_handler = [];
    protected $_url;

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function setData(array $handler)
    {
        $this->_handler = $handler;
    }

    public function resolve()
    {
        $level =  count(array_diff(explode('/', $this->_url), ['']));
        if (!isset($this->_handler[$level])) throw new \Exception("Not Found.", 1);

        foreach ($this->_handler[$level] as $pattern => $route) {
            foreach (explode('/', $pattern) as $val) {
                
            }
        }
    }

}