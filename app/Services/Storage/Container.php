<?php
namespace app\Services\Storage;

use app\Application;

/**
 * Class Container
 * @package App\Storage
 *
 * @property \app\Services\Storage\Adapters\Server\ServerStorage $server
 * @property \app\Services\Storage\Adapters\Memcached\MemcachedStorage $memcached
 * @property \app\Services\Storage\Adapters\Monolog\MonologStorage $monolog
 * @property \app\Services\Storage\Adapters\CacheApc\CacheApcStorage $apcCache
 * @property \app\Services\Storage\Adapters\Redis\RedisStorage $redis
 * @property \app\Services\Storage\Adapters\Mongo\MongoStorage $mongo
 */
class Container
{
    private $app;
    private $container;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function __get($name)
    {
        if (!isset($this->container[$name]))
            $this->container[$name] = Factory::create($name, $this->app);

        return $this->container[$name];
    }

}