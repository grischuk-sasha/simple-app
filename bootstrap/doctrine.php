<?php
require_once __DIR__.'/defines.php';
require_once BASE_DIR.'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [
    SRC_DIR."entities"
];

$dbParams = require SRC_DIR.'configs/db.php';

$config = Setup::createAnnotationMetadataConfiguration($paths, DEBUG);
return EntityManager::create($dbParams, $config);