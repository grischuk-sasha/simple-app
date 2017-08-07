<?php
namespace app;

use app\Services\Cache\EnServices as EnCacheServices;
use app\Services\Cache\Provider as CacheProvider;

use app\Services\Storage\EnServices as EnStorageServices;
use app\Services\Storage\Provider as StorageProvider;

use app\Services\File\EnServices as EnFileServices;
use app\Services\File\Provider as FileProvider;

use app\Services\Http\EnServices as EnHttpServices;
use app\Services\Http\Provider as HttpProvider;

class ServicesFactory
{
    public static function create(Application $app, $serviceName)
    {
        switch($serviceName) {
            case EnCacheServices::CACHE:
                return $app->register($app->getProvider(CacheProvider::class), $serviceName);
                break;

            case EnStorageServices::STORAGE:
                return $app->register($app->getProvider(StorageProvider::class), $serviceName);
                break;

            case EnFileServices::FILE_MANAGER:
                return $app->register($app->getProvider(FileProvider::class), $serviceName);
                break;

            case EnHttpServices::REQUEST:
                return $app->register($app->getProvider(HttpProvider::class), $serviceName);
                break;

            case EnHttpServices::HTTP_CLIENT:
                return $app->register($app->getProvider(HttpProvider::class), $serviceName);
                break;
        }

    }

}