<?php
namespace app\Services\Cache;

use app\Services\Storage\EnStorageName;
use app\Services\Storage\Adapters\Memcached\Model as MemcachedModel;
use app\Services\Storage\Adapters\Memcache\Model as MemcacheModel;
use app\Services\Storage\Adapters\CacheApc\Model as CacheApcModel;
use app\Services\Storage\Adapters\Mongo\Model as MongoModel;
use app\Exception\FatalError;

class FactoryModel
{
    public static function create($storage, array $data)
    {
        switch($storage) {

            case EnStorageName::MEMCACHED:
                return new MemcachedModel([
                    'key' => $data['key'],
                    'value' => $data['value']
                ]);
                break;

            case EnStorageName::MEMCACHE:
                return new MemcacheModel([
                    'key' => $data['key'],
                    'value' => $data['value']
                ]);
                break;

            case EnStorageName::CACHE_APC:
                return new CacheApcModel([
                    'key' => $data['key'],
                    'value' => $data['value']
                ]);
                break;

            case EnStorageName::MONGO:
                return new MongoModel([
                    'key' => $data['key'],
                    'value' => $data['value'],
                    'collection' => 'cache'
                ]);
                break;


            default:
                throw new FatalError('Storage '.$storage.' was not found.');
        }

    }

}