<?php
namespace app\Services\Storage\Adapters;

interface StorageInterface
{
    public function getName();
    public function set(Model $model);
    public function get(Query $query);
    public function flushAll();

}