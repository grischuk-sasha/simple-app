<?php
namespace app\Services\Http;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request
{
    private static $instance;

    public static function init()
    {
        if (self::$instance === null)
            self::$instance = SymfonyRequest::createFromGlobals();

        return self::$instance;
    }

}