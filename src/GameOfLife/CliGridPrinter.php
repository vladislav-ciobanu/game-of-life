<?php

namespace GameOfLife;

/**
 * Class CliGridPrinter
 *
 * @package GameOfLife
 */
class CliGridPrinter implements GridPrinter
{
    /**
     * @var array
     */
    private static $cellStateCharMap = array(
        CellState::DEAD  => '.',
        CellState::ALIVE => 'O'
    );

    /**
     * @var int
     */
    private $displayDelay;

    /**
     * @param int $displayDelay
     */
    public function __construct($displayDelay = 100000)
    {
        $this->displayDelay = $displayDelay;
    }

    /**
     * @param Grid $grid
     */
    public function doPrint(Grid $grid)
    {
        $output = PHP_EOL;

        /* @var Cell[] $line */
        foreach ($grid->getCells() as $line) {
            foreach ($line as $cell) {
                $output .= self::$cellStateCharMap[$cell->getState()] . ' ';
            }
            $output .= PHP_EOL;
        }

        $output .= PHP_EOL;

        echo $output;

        ob_flush();

        if ($this->displayDelay > 0) {
            usleep($this->displayDelay);
        }
    }
}