<?php
namespace app;

interface ProviderInterface
{
    public function register(Application $app, $serviceName);
}