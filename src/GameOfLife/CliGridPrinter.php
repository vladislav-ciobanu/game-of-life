<?php

namespace GameOfLife;

/**
 * Class CliGridPrinter
 * @package GameOfLife
 */
class CliGridPrinter implements GridPrinter
{
    /**
     * @param Grid $grid
     */
    public function doPrint(Grid $grid)
    {
        $output = PHP_EOL;

        /* @var Cell[] $line */
        foreach ($grid as $line) {
            foreach ($line as $cell) {
                $output .= $cell->getState();
            }
            $output .= PHP_EOL;
        }

        $output .= PHP_EOL;

        echo $output;
    }
}