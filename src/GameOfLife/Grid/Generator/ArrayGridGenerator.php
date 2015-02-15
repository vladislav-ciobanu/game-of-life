<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Cell;
use GameOfLife\Grid\CellState;
use GameOfLife\Grid\Grid;

/**
 * Class ArrayGridGenerator
 *
 * @package GameOfLife\Grid\Generator
 */
class ArrayGridGenerator implements GridGenerator
{

   /**
     * @inheritdoc
     */
    public function generate($sourceData, $maxRowLimit = null, $maxColumnLimit = null)
    {
        $grid = new Grid($maxRowLimit, $maxColumnLimit);

        /* @var int[][] $sourceData */
        foreach ($sourceData as $positionY => $line) {
            foreach ($line as $positionX => $value) {
                $cellState = $value === CellState::ALIVE ? CellState::ALIVE : CellState::DEAD;
                $grid->setCell(new Cell($cellState, $positionX, $positionY));
            }
        }

        return $grid;
    }
}
