<?php
namespace app\Services\Storage\Adapters\CacheApc;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Model as BaseModel;

class Model extends BaseModel
{
    protected function validate()
    {
        if ($this->data->key === null)
            throw new FatalError('You must add field "key" to the apc cache model.');

        if ($this->data->value === null)
            throw new FatalError('You must add field "value" to the apc cache model.');

        if ($this->data->ttl === null)
            $this->data->ttl = 0;
    }

    public function getKey()
    {
        return $this->data->key;
    }

    public function getValue()
    {
        return $this->data->value;
    }

    public function getTtl()
    {
        return $this->data->ttl;
    }

}