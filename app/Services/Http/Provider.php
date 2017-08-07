<?php
namespace app\Services\Http;

use app\ProviderInterface;
use app\Application;
use app\Exceptions\FatalError;

class Provider implements ProviderInterface
{
    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::HTTP_CLIENT:
                return $app->$serviceName = (new Manager($app->request))->getClient();
                break;

            case EnServices::REQUEST:
                return $app->$serviceName = Request::init();
                break;

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}