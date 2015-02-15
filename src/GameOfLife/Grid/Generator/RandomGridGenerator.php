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
    /**
     * @var int
     */
    private $maxRows;

    /**
     * @var int
     */
    private $maxCols;

    /**
     * @var int
     */
    private $minRows;

    /**
     * @var int
     */
    private $minCols;

    /**
     * @param int $maxRows
     * @param int $maxCols
     * @param int $minRows
     * @param int $minCols
     */
    public function __construct($maxRows = 10, $maxCols = 10, $minRows = 3, $minCols = 3)
    {
        $this->maxRows = $maxRows;
        $this->maxCols = $maxCols;
        $this->minRows = $minRows;
        $this->minCols = $minCols;
    }

    /**
     * @inheritdoc
     */
    public function generate($sourceData = null, $maxRowLimit = null, $maxColumnLimit = null)
    {
        $numberOfRows    = mt_rand($this->minRows, $this->maxRows);
        $numberOfColumns = mt_rand($this->minCols, $this->maxCols);

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