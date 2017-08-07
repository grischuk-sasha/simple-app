<?php
namespace app\Services\Storage\Adapters\Redis;

use app\Services\Storage\Adapters\Query as BaseQuery;

class Query extends BaseQuery
{
    use traitValidate;

    public function validate()
    {
        $this->commonValidate();

        if (empty($this->data->operator))
            $this->data->operator = 'get';

        return true;
    }

    public function getCondition()
    {
        return $this->data->key;
    }

    public function getOperator()
    {
        return $this->data->operator;
    }
}