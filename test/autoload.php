<?php
include_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Composer\Autoload\ClassLoader();
$loader->addPsr4("Core\\Test\\", "src/test", true);
$loader->register();