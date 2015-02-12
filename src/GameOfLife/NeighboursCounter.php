<?php

namespace GameOfLife;

use GameOfLife\Grid\Cell;
use GameOfLife\Grid\Grid;

/**
 * Interface NeighboursCounter
 *
 * @package GameOfLife
 */
interface NeighboursCounter
{
    /**
     * @param Grid $grid
     * @param Cell $cell
     * @return int
     */
    public function countLiving(Grid $grid, Cell $cell);
}
