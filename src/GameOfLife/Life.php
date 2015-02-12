<?php

namespace GameOfLife;

use GameOfLife\Grid\Grid;
use GameOfLife\Grid\GridPrinter;

/**
 * Class Life
 *
 * @package GameOfLife
 */
class Life
{
   /**
     * @var Replicator
     */
    private $replicator;

    /**
     * @var GridPrinter
     */
    private $gridPrinter;

    /**
     * @param Replicator    $replicator
     * @param GridPrinter   $gridPrinter
     */
    public function __construct(Replicator $replicator, GridPrinter $gridPrinter)
    {
        $this->replicator    = $replicator;
        $this->gridPrinter   = $gridPrinter;
    }

    /**
     * @param Grid $grid
     * @param int|null $maxNbOfGenerations
     */
    public function play(Grid $grid, $maxNbOfGenerations = null)
    {
        $currentGeneration = 1;

        $this->gridPrinter->doPrint($grid);

        while (null === $maxNbOfGenerations || $currentGeneration++ <= $maxNbOfGenerations) {
            $newGrid = $this->replicator->replicate($grid);
            $this->gridPrinter->doPrint($newGrid);
            $grid = $newGrid;
        }
    }
}
