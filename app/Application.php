<?php
namespace app;

/**
 * Class Application
 * @package app
 *
 * @property \app\Services\Cache\Manager $cache
 * @property \app\Services\Storage\Container $storage
 * @property \app\Services\File\Manager $fileManager
 * @property \Symfony\Component\HttpFoundation\Request $request
 * @property \app\Services\Http\ClientInterface $httpClient
 */
class Application
{
    private $container = [];
    private $providers = [];
    protected static $_instance;

    private function __construct(){}
    private function __clone(){}

    public function __get($name)
    {
        return isset($this->container[$name]) ? $this->container[$name] : ServicesFactory::create($this, $name);
    }

    public static function init() {

        if (null === self::$_instance)
            self::$_instance = new self();

        return self::$_instance;
    }

    public function register(ProviderInterface $provider, $serviceName)
    {
        return $provider->register($this, $serviceName);
    }

    public function getProvider($name)
    {
        if (!isset($this->providers[$name]))
            $this->providers[$name] = new $name;

        return $this->providers[$name];
    }
}