<?php

namespace GameOfLife;

/**
 * Interface GridPrinter
 *
 * @package GameOfLife
 */
interface GridPrinter
{

    /**
     * @param Grid $grid
     */
    public function doPrint(Grid $grid);
}
