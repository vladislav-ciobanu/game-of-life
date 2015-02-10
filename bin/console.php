<?php
require __DIR__ . '/../vendor/autoload.php';

use \GameOfLife\ConwayRuleSet;
use \GameOfLife\GridGeneratorFactory;
use \GameOfLife\GridManager;
use \GameOfLife\LifeCommand;
use \GameOfLife\SimpleNeighboursCounter;
use \GameOfLife\SimpleReplicator;

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(
    new LifeCommand(
        new SimpleReplicator(
            new ConwayRuleSet(),
            new SimpleNeighboursCounter(),
            new GridManager()
        ),
        new GridGeneratorFactory()
    )
);

$application->run();
