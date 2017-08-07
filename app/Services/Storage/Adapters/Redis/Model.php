<?php
namespace app\Services\Storage\Adapters\Redis;

use app\Services\Storage\Adapters\Model as BaseModel;

class Model extends BaseModel
{
    use traitValidate;

    public function validate()
    {
        $this->commonValidate();

        if ($this->data->value === null)
            throw new \Exception('You must add field "value" to the redis model.');

        if ($this->data->operator === null)
            $this->data->operator = 'set';

        return true;
    }

    public function getOperator()
    {
        return $this->data->operator;
    }

    public function getKey()
    {
        return $this->data->key;
    }

    public function getValue()
    {
        return $this->data->value;
    }
}