<?php
require_once __DIR__.'/defines.php';
require_once BASE_DIR.'vendor/autoload.php';

function app() {
    return app\Application::init();
}

$container = require SRC_DIR.'Container.php';
$request = app()->request;
/** @var \src\components\http\Kernel $kernel */
$kernel = $container->get('kernel');
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);