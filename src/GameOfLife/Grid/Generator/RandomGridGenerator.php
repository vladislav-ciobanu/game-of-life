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
        $maxRows = $this->getMaxLimit($maxRowLimit, self::DEFAULT_MAX_ROWS);
        $maxColumns = $this->getMaxLimit($maxColumnLimit, self::DEFAULT_MAX_COLUMNS);

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

    /**
     * @param null|int $maxLimit
     * @param int $defaultLimit
     * @return int
     */
    private function getMaxLimit($maxLimit, $defaultLimit)
    {
        return $maxLimit === null || $maxLimit > $defaultLimit ? $defaultLimit : $maxLimit;
    }
}
