<?php
namespace app\Services\Logger;

use app\Services\Storage\Container;
use Symfony\Component\HttpFoundation\Request;

class Manager
{
    private $_storage = null;
    private $_request = null;
    protected $_storages = [];

    public function __construct(Container $storageContainer, Request $request){
        $this->_storages = $storageContainer;
        $this->_request = $request;
        $this->_storage = $this->_storages->server;
    }

    public function store($name){
        $this->_storage = $this->_storages->$name;
        return $this;
    }

    public function write($body)
    {
        if (is_array($body)) {
            $body = array_merge($body, [
                'COOKIE'  => $this->_request->cookies->all(),
                'SESSION' => $this->_request->getSession()->all(),
                'POST'    => $this->_request->request->all(),
                'GET'     => $this->_request->query->all(),
                'SERVER'  => $this->_request->server->all(),
            ]);
        }

        return $this->_storage->set(FactoryLog::create($this->_storage->getName(), $body));
    }

    public function read()
    {

    }

}