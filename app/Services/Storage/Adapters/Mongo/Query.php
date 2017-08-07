<?php
namespace app\Services\Storage\Adapters\Mongo;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Query  as BaseQuery;

class Query extends BaseQuery
{
    public function validate()
    {
        if ($this->data->key === null)
            throw new FatalError('You must add field "key" to the mongo query.');

        if ($this->data->collection === null)
            throw new FatalError('You must add field "collection" to the mongo query.');
    }

    public function getCondition()
    {
        return [
            'key' => $this->data->key
        ];
    }

    public function getCollection()
    {
        return $this->data->collection;
    }
}