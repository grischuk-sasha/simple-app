<?php

if (file_exists(__DIR__.'/db-local.php'))
    $dbLocal = require __DIR__.'/db-local.php';
else
    $dbLocal = [];

return array_merge([
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'simple_app_db',
], $dbLocal);
