<?php
namespace src\components\http;

use Psr\Log\LoggerInterface,
    Symfony\Component\DependencyInjection\Container,
    Symfony\Component\HttpKernel\Controller\ControllerResolver as SControllerResolver
;

class ControllerResolver extends SControllerResolver
{
    private $container;

    public function __construct(Container $container, LoggerInterface $logger = null)
    {
        $this->container = $container;
        parent::__construct($logger);
    }

    /**
     * Create controller
     *
     * @param string $class
     * @return object
     */
    protected function instantiateController($class)
    {
        return new $class($this->container);
    }
}