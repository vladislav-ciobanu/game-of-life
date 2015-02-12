<?php

namespace GameOfLife\Grid;

/**
 * Interface GridPrinter
 *
 * @package GameOfLife\Grid
 */
interface GridPrinter
{

    /**
     * @param Grid $grid
     */
    public function doPrint(Grid $grid);
}
