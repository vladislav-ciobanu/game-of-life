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
     * @param null|int $maxNbOfGenerations
     * @param null|int $maxRowLimit
     * @param null|int $maxColumnLimit
     */
    public function play($maxNbOfGenerations = null, $maxRowLimit = null, $maxColumnLimit = null)
    {
        $currentGeneration = 1;

        $grid = $this->gridGenerator->generate($maxRowLimit, $maxColumnLimit);
        $this->gridPrinter->doPrint($grid);

        while (null === $maxNbOfGenerations || $currentGeneration++ <= $maxNbOfGenerations) {
            $newGrid = $this->replicator->replicate($grid);
            $this->gridPrinter->doPrint($newGrid);
            $grid = $newGrid;
        }
    }
}
