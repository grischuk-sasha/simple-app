<?php
namespace src\components\http\api;

use src\components\base\Container;
use src\components\http\Controller as BaseController;
use src\components\view\FactoryView;

class Controller extends BaseController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }
}