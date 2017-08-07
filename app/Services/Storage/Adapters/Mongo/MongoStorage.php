<?php
namespace app\Services\Storage\Adapters\Mongo;

use app\Services\Storage\Adapters\StorageInterface;
use app\Services\Storage\Adapters\Storage;
use app\Services\Storage\EnStorageName;
use app\Services\Storage\Adapters\Model as BaseModel;
use app\Services\Storage\Adapters\Query as BaseQuery;

class MongoStorage extends Storage implements StorageInterface
{
    private $client;
    private $db;

    public function getName()
    {
        return EnStorageName::MONGO;
    }

    public function __construct()
    {
        $this->client = new \MongoClient();
        $this->db = $this->client->selectDB('test_db');
    }

    public function get(BaseQuery $query)
    {
        return $this->doGet($query);
    }

    private function doGet(Query $query)
    {
        $collection = $this->db->selectCollection($query->getCollection());

        return $collection->find($query->getCondition())->getNext() ; //->getNext()['data'];
    }

    public function set(BaseModel $model)
    {
        return $this->doSet($model);
    }

    private function doSet(Model $model)
    {
        $collection = $this->db->selectCollection($model->getCollection());

        return $collection->insert($model->getData(), $model->getOptions());
    }

    public function flushAll()
    {
        // TODO: Implement flush() method.
    }

}