<?php
require __DIR__ . '/../vendor/autoload.php';

use \GameOfLife\Util\ServiceContainer;
use \GameOfLife\Util\ServiceName;

ServiceContainer::getService(ServiceName::APPLICATION)->run();

