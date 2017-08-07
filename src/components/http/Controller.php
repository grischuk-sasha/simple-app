<?php
namespace src\components\http;

use Symfony\Component\DependencyInjection\Container;

class Controller
{
    /**
     * @var \src\components\base\Container $container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getEntityName()
    {
        $ctrlName = (new \ReflectionClass($this))->getShortName();
        return strtolower(str_replace('Controller', '', $ctrlName));
    }

}