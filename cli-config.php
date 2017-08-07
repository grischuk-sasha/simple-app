<?php

$entityManager = require_once __DIR__."/bootstrap/doctrine.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);