<?php
declare(strict_types=1);

namespace Core;

class Request
{

    /**
     * @var string $requestMethodName
     */
    protected $requestMethodName;

        /**
     * @var array $_httpMethod
     */
    protected $_httpMethod = ['get', 'post', 'put', 'delete'];

    public function __construct()
    {
        $this->requestMethodName = strtolower($_SERVER['REQUEST_METHOD']);
        if (!in_array($this->requestMethodName, $this->_httpMethod)) 
            throw new \Exception("Not Support Http Method Name.", 1);
    }

    public function isGet()
    {
        return $this->requestMethodName === "get";
    }

    public function isPost()
    {
        return $this->requestMethodName === "post" && (!isset($_POST['@METHOD']) || $_POST['@METHOD'] === 'POST');
    }

    public function isPut()
    {
        if ($_POST && $_POST['@METHOD'] === 'PUT') return true;
        return $this->requestMethodName === "put";
    }

    public function isDelete()
    {
        if ($_POST && $_POST['@METHOD'] === 'DELETE') return true;
        return $this->requestMethodName === "delete";
    }

    public function getMethod()
    {
        if ($this->isGet()) return 'GET';
        else if ($this->isPost()) return 'POST';
        else if ($this->isPut()) return 'PUT';
        else if ($this->isDelete()) return 'DELETE';
        
        if ($this->requestMethodName === 'post' && isset($_POST['@METHOD']) && !in_array($_POST['@METHOD'], ['PUT', 'DELETE']) ) 
            throw new \Exception("Not Support Http Method Name.", 1);
    }
}