<?php
namespace app\Services\Logger;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Monolog\Model as MonologModel;

class FactoryLog
{
    public static function create($storageName, $body)
    {
        switch($storageName) {

            case 'monolog':
                if (!isset($body['message']))
                    throw new FatalError('You must add field "message".');

                $logName = $body['message'];
                unset($body['message']);

                return new MonologModel([
                    'name' => $logName,
                    'body' => $body
                ]);
                break;

            default:
                throw new FatalError('Storage '.$storageName.' was not found.');
        }

    }

}