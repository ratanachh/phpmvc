<?php
declare(strict_types=1);

namespace Core;

use DI\Container;

class Application
{

    /**
     * @var Container $di
     */
    protected $di;

    public function __construct(Container $di)
    {
        $this->di = $di;
    }

    public function handle(string $url)
    {
        $this->di->get('router')->handle($url);
        return $this;
    }

    public function getContent()
    {
        return "";
    }

}