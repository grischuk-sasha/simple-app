<?php
namespace app\Services\Mailer;

use app\ProviderInterface;
use app\Application;
use app\Exceptions\FatalError;
use app\Services\Mailer\Adapters\Swift\Mailer as SwiftMailer;

class Provider implements ProviderInterface
{
    public function register(Application $app, $serviceName)
    {
        switch ($serviceName) {

            case EnServices::SWIFT_MAILER:
                return new SwiftMailer();

            default:
                throw new FatalError('Service '.$serviceName.' was not found.');
        }
    }

}