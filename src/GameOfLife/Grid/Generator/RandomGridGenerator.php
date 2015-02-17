<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Cell;
use GameOfLife\Grid\CellState;
use GameOfLife\Grid\Grid;

/**
 * Class RandomGridGenerator
 *
 * @package GameOfLife\Grid\Generator
 */
class RandomGridGenerator implements GridGenerator
{
    const DEFAULT_MIN_ROWS = 3;
    const DEFAULT_MIN_COLUMNS = 3;
    const DEFAULT_MAX_ROWS = 10;
    const DEFAULT_MAX_COLUMNS = 10;


    /**
     * @inheritdoc
     */
    public function generate($sourceData = null, $maxRowLimit = null, $maxColumnLimit = null)
    {
        $maxRows = $maxRowLimit === null || $maxRowLimit > self::DEFAULT_MAX_ROWS
                ? self::DEFAULT_MAX_ROWS : $maxRowLimit;
        $maxColumns = $maxColumnLimit === null || $maxColumnLimit > self::DEFAULT_MAX_COLUMNS
                ? self::DEFAULT_MAX_COLUMNS : $maxColumnLimit;

        $numberOfRows = mt_rand(self::DEFAULT_MIN_ROWS, $maxRows);
        $numberOfColumns = mt_rand(self::DEFAULT_MIN_COLUMNS, $maxColumns);

        $grid = new Grid($maxRowLimit, $maxColumnLimit);

        for ($posY = 0; $posY < $numberOfRows; $posY++) {
            for ($posX = 0; $posX < $numberOfColumns; $posX++) {
                $randomState = mt_rand(CellState::DEAD, CellState::ALIVE);
                $grid->setCell(new Cell($randomState, $posX, $posY));
            }
        }

        return $grid;
    }
}
