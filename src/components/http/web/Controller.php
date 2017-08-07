<?php
namespace src\components\http\web;

use src\components\base\Container;
use src\components\http\Controller as BaseController;
use src\components\view\template\PhpEngine;

class Controller extends BaseController
{
    /** @var PhpEngine $templateEngine */
    private $templateEngine;

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->templateEngine = new PhpEngine();
    }

    public function setTitle($title)
    {
        $this->templateEngine->getSlots()->set('title', $title);
    }

    public function render($tplName, $data = [])
    {
        return $this->templateEngine->render($this->getEntityName().'/'.$tplName, $data);
    }
}