<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\Cell;
use GameOfLife\CellState;
use GameOfLife\Grid;
use GameOfLife\GridGenerator;

/**
 * Class ArrayGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class ArrayGenerator implements GridGenerator
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param null|int $maxRowLimit
     * @param null|int $maxColumnLimit
     * @return Grid
     */
    public function generate($maxRowLimit = null, $maxColumnLimit = null)
    {
        $grid = new Grid($maxRowLimit, $maxColumnLimit);

        foreach ($this->data as $positionY => $line) {
            foreach ($line as $positionX => $value) {
                $cellState = $value === CellState::ALIVE ? CellState::ALIVE : CellState::DEAD;
                $grid->setCell(new Cell($cellState, $positionX, $positionY));
            }
        }

        return $grid;
    }
}
