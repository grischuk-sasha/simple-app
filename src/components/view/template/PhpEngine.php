<?php
namespace src\components\view\template;

use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine as SPhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

class PhpEngine extends SPhpEngine
{
    public function __construct()
    {
        $loader = new FilesystemLoader(SRC_DIR.'views/%name%');

        parent::__construct(new TemplateNameParser(), $loader);

        $this->set(new SlotsHelper());
    }

    /** @return SlotsHelper */
    public function getSlots()
    {
        return $this->get('slots');
    }
}