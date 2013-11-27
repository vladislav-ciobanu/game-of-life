<?php

namespace GameOfLife;

/**
 * Class Life
 *
 * @package GameOfLife
 */
class Life
{
    /**
     * @var GridGenerator
     */
    private $gridGenerator;

    /**
     * @var Replicator
     */
    private $replicator;

    /**
     * @var GridPrinter
     */
    private $gridPrinter;

    /**
     * @param GridGenerator $gridGenerator
     * @param Replicator    $replicator
     * @param GridPrinter   $gridPrinter
     */
    public function __construct(GridGenerator $gridGenerator, Replicator $replicator, GridPrinter $gridPrinter)
    {
        $this->gridGenerator = $gridGenerator;
        $this->replicator    = $replicator;
        $this->gridPrinter   = $gridPrinter;
    }

    /**
     * @param null|int $maxNumberOfGenerations
     */
    public function play($maxNumberOfGenerations = null)
    {
        $currentGeneration = 1;

        $grid = $this->gridGenerator->generate();
        $this->gridPrinter->doPrint($grid);

        while (null === $maxNumberOfGenerations || $currentGeneration++ <= $maxNumberOfGenerations) {
            $newGrid = $this->replicator->replicate($grid);
            $this->gridPrinter->doPrint($newGrid);
            $grid = $newGrid;
        }
    }
}