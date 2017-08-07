<?php
namespace app\Services\Cache;

use app\exceptions\FatalError;
use app\ProviderInterface;
use app\Application;

class Provider implements ProviderInterface
{
    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::CACHE:
                return $app->$serviceName = new Manager($app->storage);
                break;

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}