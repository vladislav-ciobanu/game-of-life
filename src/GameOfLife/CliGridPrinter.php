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
    const CELL_SEPARATOR = ' ';

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
        $output = array(PHP_EOL);


        $grid->forEachCell($this->printCell($output), function () use (&$output) {
            $output[] = PHP_EOL;
        });

        $output[] = PHP_EOL;

        $this->output->write(implode('', $output));

        if ($this->displayDelay > 0) {
            usleep($this->displayDelay);
        }
    }

    /**
     * @param array $output
     * @return \Closure
     */
    private function printCell(array &$output)
    {
        $cellStateCharMap = self::$cellStateCharMap;
        $cellSeparator = self::CELL_SEPARATOR;

        return function(Cell $cell) use (&$output, $cellStateCharMap, $cellSeparator) {
            array_push($output, $cellStateCharMap[$cell->getState()], $cellSeparator);
        };
    }
}
