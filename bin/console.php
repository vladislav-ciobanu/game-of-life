<?php
require 'vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GameOfLife\LifeCommand());
$application->run();