<?php
namespace app\Services\Storage\Adapters\CacheApc;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Query  as BaseQuery;

class Query extends BaseQuery
{
    public function validate()
    {
        if ($this->data->key === null)
            throw new FatalError('You must add to the query key.');
    }

    public function getCondition()
    {
        return $this->data->key;
    }

    public function getSuccess()
    {
        return $this->data->success;
    }
}