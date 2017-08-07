<?php

namespace app\Services\Cache;

use app\Services\Storage\Container;
use app\Services\Storage\EnStorageName;

class Manager
{
    /**
     * @var \app\Services\Storage\Adapters\StorageInterface $_storage
     */
    private $storage = null;
    private $storageContainer = [];

    public function __construct(Container $storageContainer)
    {
        $this->storageContainer = $storageContainer;
        $this->setDefaultStore();
    }

    public function store($name)
    {
        $this->storage = $this->storageContainer->$name;
        return $this;
    }

    public function getKeyName($name)
    {
        return constant( EnKeys::class."::".$name );
    }

    /**
     * Default storage is memcached.
     * @return $this
     */
    public function setDefaultStore()
    {
        $this->store(EnStorageName::MEMCACHED);
        return $this;
    }

    public function setData($key, $value)
    {
        $obj = FactoryModel::create($this->storage->getName(), [
            'key' => $key,
            'value' => $value
        ]);

        return $this->storage->set($obj);
    }

    public function getData($key)
    {
        $query = QueryFactory::make($this->storage->getName(), $key);

        return $this->storage->get($query);
    }

    public function getStorage()
    {
        return $this->storage;
    }

    public function flushStorage()
    {
        return $this->storage->flushAll();
    }

}