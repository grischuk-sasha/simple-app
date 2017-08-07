<?php
namespace app\Services\Cache;

use app\Exceptions\FatalError;
use app\Services\Storage\Adapters\Memcached\Query as MemcachedQuery;
use app\Services\Storage\Adapters\CacheApc\Query as CacheApcQuery;
use app\Services\Storage\Adapters\Mongo\Query as MongoQuery;
use app\Services\Storage\EnStorageName;

class QueryFactory
{

    public static function make($storageName, $key)
    {
        switch ($storageName) {

            case EnStorageName::MEMCACHE:
                return new MemcacheQuery([
                    'key' => $key,
                    'flags' => false
                ]);
                break;

            case EnStorageName::MEMCACHED:
                return new MemcachedQuery([
                    'key' => $key
                ]);
                break;

            case EnStorageName::CACHE_APC:
                return new CacheApcQuery([
                    'key' => $key,
                    'success' => null
                ]);
                break;

            case EnStorageName::MONGO:
                return new MongoQuery([
                    'key' => $key,
                    'collection' => 'cache'
                ]);
                break;

            default:
                throw new FatalError('Storage not found.');
        }
    }

}