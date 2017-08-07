<?php
namespace app\Services\Storage;

use app\Application;
use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\CacheApc\CacheApcStorage;
use app\Services\Storage\Adapters\Memcache\MemcacheStorage;
use app\Services\Storage\Adapters\Memcached\MemcachedStorage;
use app\Services\Storage\Adapters\Monolog\MonologStorage;
use app\Services\Storage\Adapters\Redis\RedisStorage;
use app\Services\Storage\Adapters\Server\ServerStorage;
use app\Services\Storage\Adapters\Mongo\MongoStorage;

class Factory
{

    public static function create($storageName = EnStorageName::MEMCACHE, Application $app )
    {
        switch ($storageName) {

            case EnStorageName::MEMCACHE:
                return new MemcacheStorage();
                break;

            case EnStorageName::MEMCACHED:
                return new MemcachedStorage();
                break;

            case EnStorageName::SERVER:
                return new ServerStorage($app->httpClientManager->client);
                break;

            case EnStorageName::MONOLOG:
                return new MonologStorage();
                break;

            case EnStorageName::CACHE_APC:
                return new CacheApcStorage();
                break;

            case EnStorageName::MONGO:
                return new MongoStorage();
                break;

            case EnStorageName::REDIS:
                return new RedisStorage();
                break;

            default:
                throw new FatalError('Storage '.$storageName.' was not found.');
                break;
        }
    }

}