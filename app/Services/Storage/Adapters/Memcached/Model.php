<?php
namespace app\Services\Storage\Adapters\Memcached;

use app\Services\Storage\Adapters\Model as BaseModel;

class Model extends BaseModel
{
    const DEFAULT_EXPIRE = 3600;

    protected function validate()
    {
        if ($this->data->key === null)
            throw new \Exception('You must add field "key" to the memcached model.');

        if ($this->data->value === null)
            throw new \Exception('You must add field "value" to the memcached model.');

        if ($this->data->expire === null)
            $this->data->expire = self::DEFAULT_EXPIRE;

        return true;
    }

    public function getKey()
    {
        return $this->data->key;
    }

    public function getValue()
    {
        return $this->data->value;
    }

    public function getExpire()
    {
        return $this->data->expire;
    }

}