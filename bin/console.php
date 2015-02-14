<?php
require __DIR__ . '/../vendor/autoload.php';

use \GameOfLife\ConwayRuleSet;
use \GameOfLife\Grid\Generator\ArrayGridGenerator;
use \GameOfLife\Grid\Generator\PatternGridGenerator;
use \GameOfLife\Grid\Generator\RandomGridGenerator;
use \GameOfLife\Grid\GridManager;
use \GameOfLife\LifeCommand;
use \GameOfLife\SimpleNeighboursCounter;
use \GameOfLife\SimpleReplicator;
use GameOfLife\Util\GamePatternsLoader;

use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;

$application = new Application();
$gamePatternsLoader = new GamePatternsLoader(new Finder());

$application->add(
    new LifeCommand(
        new SimpleReplicator(
            new ConwayRuleSet(),
            new SimpleNeighboursCounter(),
            new GridManager()
        ),
        new PatternGridGenerator($gamePatternsLoader, new ArrayGridGenerator()),
        new RandomGridGenerator(),
        $gamePatternsLoader
    )
);

$application->run();
