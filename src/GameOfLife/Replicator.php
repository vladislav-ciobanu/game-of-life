<?php

namespace GameOfLife;

use GameOfLife\Grid\Grid;

/**
 * Interface Replicator
 *
 * @package GameOfLife
 */
interface Replicator
{

    /**
     * @param Grid $grid
     * @return Grid
     */
    public function replicate(Grid $grid);
}
