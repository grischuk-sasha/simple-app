<?php
namespace app\Services\Storage\Adapters;

abstract class Query
{
    protected $data = null;

    public function __construct(array $query)
    {
        $this->data = (object) $query;
        $this->validate();
    }

    abstract protected function validate();
}