<?php
declare(strict_types=1);

namespace Core;

use Core\Interfaces\InjectableInterface;
use DI\Container;

class Controller extends Application implements InjectableInterface
{
    /**
     * @var View $view
     */
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function setDI(Container $di)
    {
        $this->di = $di;
        $this->registerService($di);
    }

    protected function registerService(Container $di){
        $this->route = $di->get('router');
        $this->config = $di->get('config');
        $this->session = $di->get('session');
    }

}