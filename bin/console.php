<?php
require __DIR__ . '/../vendor/autoload.php';

use \GameOfLife\Util\ServiceContainer;
use \GameOfLife\Util\ServiceName;

/* @var $application \Symfony\Component\Console\Application */
$application = ServiceContainer::getService(ServiceName::APPLICATION);
$application->run(
    ServiceContainer::getService(ServiceName::ARGV_INPUT),
    ServiceContainer::getService(ServiceName::CONSOLE_OUTPUT)
);

