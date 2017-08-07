<?php
namespace src\components\http;

use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel
{
    public function __construct($dispatcher, $resolver, $requestStack = null)
    {
        parent::__construct($dispatcher, $resolver, $requestStack);
    }

}