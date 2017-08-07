<?php
namespace app\Services\Storage\Adapters\CacheApc;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\StorageInterface;
use app\Services\Storage\Adapters\Storage;
use app\Services\Storage\EnStorageName;
use app\Services\Storage\Adapters\Model as BaseModel;
use app\Services\Storage\Adapters\Query as BaseQuery;

class CacheApcStorage extends Storage implements StorageInterface
{
    public function __construct()
    {
        if(!extension_loaded('apc'))
            throw new FatalError('PHP APC package is not installed.');
    }

    public function getName()
    {
        return EnStorageName::CACHE_APC;
    }

    public function get(BaseQuery $query)
    {
        return $this->doGet($query);
    }

    private function doGet(Query $query)
    {
        return apc_fetch($query->getCondition(), $query->getSuccess());
    }

    public function set(BaseModel $model)
    {
        return $this->doSet($model);
    }

    private function doSet(Model $model)
    {
        apc_store($model->getKey(), $model->getValue(), $model->getTtl());
        return $this;
    }

    public function flushAll()
    {
        return apc_clear_cache();
    }

}