<?php
namespace app\Services\Storage\Adapters\Memcached;

use app\Services\Storage\Adapters\Storage;
use app\Services\Storage\EnStorageName;
use app\Services\Storage\Adapters\StorageInterface;
use app\Services\Storage\Adapters\Model as BaseModel;
use app\Services\Storage\Adapters\Query as BaseQuery;

class MemcachedStorage extends Storage implements StorageInterface
{
    const DEFAULT_HOST = '127.0.0.1';
    const DEFAULT_PORT = 11211;

    private $_server = null;

    public function __construct($host = self::DEFAULT_HOST, $port = self::DEFAULT_PORT, $weight = 0)
    {
        $this->_server = new \Memcached;
        $this->_server->addServer($host, $port, $weight);
    }

    public function getName()
    {
        return EnStorageName::MEMCACHED;
    }

    public function set(BaseModel $model)
    {
        return $this->doSet($model);
    }

    private function doSet(Model $model)
    {
        return $this->_server->set($model->getKey(), $model->getValue(), $model->getExpire());
    }

    public function get(BaseQuery $query)
    {
        return $this->doGet($query);
    }

    private function doGet(Query $query)
    {
        $key = $query->getKey();

        return $this->_server->get($key);
    }

    public function flushAll()
    {
        return $this->_server->flush();
    }

}