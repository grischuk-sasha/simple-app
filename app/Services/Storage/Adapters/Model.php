<?php
namespace app\Services\Storage\Adapters;

abstract class Model
{
    protected $data = null;

    public function __construct(array $data)
    {
        $this->data = (object) $data;
        $this->validate();
    }

    abstract protected function validate();

}