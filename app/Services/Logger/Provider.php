<?php
namespace app\Services\Logger;

use app\ProviderInterface;
use app\Application;
use app\Exceptions\FatalError;

class Provider implements ProviderInterface
{
    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::LOG_MANAGER:
                return $app[$serviceName] = new Manager($app->storageContainer, $app->request);
                break;

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}