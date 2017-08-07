<?php
namespace app\Services\Storage\Adapters\Mongo;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Model as BaseModel;

class Model extends BaseModel
{

    public function validate()
    {
        if ($this->data->key === null)
            throw new FatalError('You must add field "key" to the mongo model.');

        if ($this->data->collection === null)
            throw new FatalError('You must add field "collection" to the mongo model.');

        if ($this->data->value === null)
            throw new FatalError('You must add field "value" to the mongo model.');

        if ($this->data->options === null)
            $this->data->options = [];
    }

    public function getData()
    {
        return [
            "key" => $this->data->key,
            "data" => $this->data->value,
        ];
    }

    public function getOptions()
    {
        return $this->data->options;
    }

    public function getCollection()
    {
        return $this->data->collection;
    }

}