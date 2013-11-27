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
     * @return Grid
     */
    public function generate()
    {
        $numberOfRows    = count($this->data);
        $numberOfColumns = count(current($this->data));

        $grid = new Grid($numberOfRows, $numberOfColumns);

        foreach ($this->data as $positionY => $line) {
            foreach ($line as $positionX => $value) {
                $cellState = $value === CellState::ALIVE ? CellState::ALIVE : CellState::DEAD;
                $grid->setCell(new Cell($cellState, $positionX, $positionY));
            }
        }

        return $grid;
    }
} 