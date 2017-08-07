<?php

namespace app\Services\Storage;

use app\Application;
use app\ProviderInterface;
use app\Exceptions\FatalError;

class Provider implements ProviderInterface
{
    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::STORAGE:
                return $app->$serviceName = new Container($app);
                break;

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}