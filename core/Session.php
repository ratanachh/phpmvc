<?php
declare(strict_types=1);

namespace Core;


class Session
{
    public function __construct()
    {
        session_start();
    }

    public function exist($name)
    {
        return isset($_SESSION[$name]);
    }

    public function get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public  function delete($name)
    {
        if ($this->exist($name))
        {
            unset($_SESSION[$name]);
        }
    }

    public function stop()
    {
        session_destroy();
    }

}
