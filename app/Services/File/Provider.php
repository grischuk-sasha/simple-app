<?php
namespace app\Services\File;

use app\ProviderInterface;
use app\Application;
use app\Exceptions\FatalError;

class Provider implements ProviderInterface
{

    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::FILE_MANAGER:
                return $app->$serviceName = new Manager($app->request);
                break;

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}