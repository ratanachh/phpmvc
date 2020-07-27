<?php
declare(strict_types=1);

namespace Core;

class Cookie
{
    
    public function set($name, $value, $expire)
    {
        if (setcookie($name, $value, (int)(time() + $expire), '/')) {
            return true;
        }
        return false;
    }


    public function delete($name)
    {
        $this->set($name, '', time() - 1);
    }


    public function get($name)
    {
        return $_COOKIE[$name];
    }


    public  function exist($name)
    {
        return isset($_COOKIE[$name]);
    }
}