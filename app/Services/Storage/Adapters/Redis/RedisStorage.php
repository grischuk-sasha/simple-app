<?php
namespace app\Services\Storage\Adapters\Redis;

use app\Services\Storage\Adapters\Storage;
use app\Services\Storage\Adapters\StorageInterface;
use app\Services\Storage\EnStorageName;
use app\Services\Storage\Adapters\Model as BaseModel;
use app\Services\Storage\Adapters\Query as BaseQuery;

class RedisStorage extends Storage implements StorageInterface
{
    const HOST = '127.0.0.1';
    const PORT = '6379';
    const PASSWORD = '';

    private $client;

    public function __construct()
    {
        $this->client = new \Predis\Client([
            'host' => self::HOST,
            'port' => self::PORT,
            'password' => self::PASSWORD
        ]);
    }

    public function getName()
    {
        return EnStorageName::REDIS;
    }

    public function get(BaseQuery $query)
    {
        return $this->doGet($query);
    }

    private function doGet(Query $query)
    {
        $operator = $query->getOperator();

        echo $operator;
        echo $query->getCondition();

        return $this->client->$operator($query->getCondition());
    }

    public function set(BaseModel $model)
    {
        return $this->doSet($model);
    }

    private function doSet(Model $model)
    {
        $operator = $model->getOperator();
        return $this->client->$operator($model->getKey(), $model->getValue());
    }

    public function flushAll()
    {
        // TODO: Implement flush() method.
    }

}