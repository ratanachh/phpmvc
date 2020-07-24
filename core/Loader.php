<?php
declare(strict_types=1);

namespace Core;

define('NAMESPACE_SEPARATOR', chr(92));

class Loader
{

    /**
     * @var array $namespaces
     */
    protected $namespaces = [];

    public function registerNamespaces(array $namespaces)
    {
        $this->namespaces = array_merge($this->namespaces, $namespaces);
    }

    public function register()
    {
        spl_autoload_register(__NAMESPACE__ .'\Loader::load');
    }

    public static function load($classes)
    {
        $load = new self();
        if (array_key_exists($classes, $load->getNamespaces())) {
            $class_array = explode(NAMESPACE_SEPARATOR, $classes);
            $class_name = array_pop($class_array);
            require_once $load->getNamespaces()[$classes] . $class_name . '.php';
        }
    }

    public function getNamespaces()
    {
        return $this->namespaces;
    }

    public function getNamespace($className)
    {
        foreach ($this->namespaces as $namespace => $dir) {
            $file = $dir . ucfirst($className) . 'Controller.php';
            if (file_exists($file)) {
                return $namespace . NAMESPACE_SEPARATOR . ucfirst($className) . 'Controller';
            } else {
                throw new \Exception("Controller $className doesn't exist in $dir.", 1);
            }
        }
        return $className;
    }
}