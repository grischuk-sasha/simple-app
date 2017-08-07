<?php
namespace src\components\http;

use Symfony\Component\Routing\Loader\YamlFileLoader,
    Symfony\Component\Routing\RouteCollection as SRouteCollection
;

class RouteCollection extends SRouteCollection
{
    public function loadCollection(YamlFileLoader $loader)
    {
        $collection = $loader->load('routing.yml');

        parent::addCollection($collection);
    }
}