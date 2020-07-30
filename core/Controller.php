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
    }

    public function __get($name)
    {
        if (!in_array($name, $this->di->getKnownEntryNames())) {
            throw new \Exception("You must register class $name in Provider.", 1);
        }
        $this->$name = $this->di->get($name);
        return $this->$name;
    }

}