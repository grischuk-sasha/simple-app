<?php
namespace app\Services\File;

use app\Services\File\Exceptions\FileException;
use app\Services\File\Providers\Flow\UploadService as FlowUploadService;
use app\Services\File\Providers\Symfony\UploadService as SymfonyUploadService;

class ServiceFactory
{
    public static function create($serviceName = EnUploadServices::FLOW, $dependencies )
    {
        switch ($serviceName) {

            case EnUploadServices::FLOW:
                return new FlowUploadService($dependencies['request']);
                break;

            case EnUploadServices::SYMFONY:
                return new SymfonyUploadService($dependencies['request']);
                break;

            default:
                throw new FileException('Upload service '.$serviceName.' was not found.');
        }
    }
}