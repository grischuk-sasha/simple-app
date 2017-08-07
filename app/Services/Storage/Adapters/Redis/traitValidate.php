<?php
namespace app\Services\Storage\Adapters\Redis;

trait traitValidate
{
    protected function commonValidate()
    {
        if ($this->data->key === null)
            throw new \Exception('You must add field "key".');

        return true;
    }
}