<?php
$baseDir =  __DIR__;
require_once $baseDir . '/vendor/autoload.php';
require_once $baseDir . '/environments.php';
LoadBaseEnvironment::load();
vendor\core\App::run();