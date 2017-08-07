<?php
namespace app\Services\Storage\Adapters\Memcached;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Query as BaseQuery;

class Query extends BaseQuery
{
    public function validate()
    {
        if ($this->data->key === null)
            throw new FatalError('You must add field "key" to the memcached query.');
    }

    public function getKey()
    {
        return $this->data->key;
    }

}