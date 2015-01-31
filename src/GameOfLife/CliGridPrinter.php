<?php

namespace GameOfLife;

use \Symfony\Component\Console\Output\OutputInterface;

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
     *
     * @var OutputInterface
     */
    private $output;
    /**
     * @var int display delay in microseconds
     */
    private $displayDelay;

    /**
     * @param OutputInterface $output
     * @param int             $displayDelay
     */
    public function __construct(OutputInterface $output, $displayDelay = 100000)
    {
        $this->displayDelay = $displayDelay;
        $this->output = $output;
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

        $this->output->write($output);

        if ($this->displayDelay > 0) {
            usleep($this->displayDelay);
        }
    }
}