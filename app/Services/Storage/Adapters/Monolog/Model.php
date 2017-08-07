<?php
namespace app\Services\Storage\Adapters\Monolog;

use app\Services\Storage\Adapters\Model as BaseModel;
use Monolog\Logger;

class Model extends BaseModel
{
    protected function validate()
    {
        if ($this->data->level === null) {
            $this->data->level = Logger::ERROR;
        }

        if ($this->data->name === null)
            throw new \Exception('You must add field "name" to the monolog model.');

        if ($this->data->body === null)
            throw new \Exception('You must add field "body" to the monolog model.');

        if (!is_array($this->data->body))
            throw new \Exception('Field "body" must be an array.');

        return true;
    }

    public function getLevel()
    {
        return $this->data->level;
    }

    public function getName()
    {
        return $this->data->name;
    }

    public function getBody()
    {
        return $this->data->body;
    }

}