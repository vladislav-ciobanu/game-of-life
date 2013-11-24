<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\Cell;
use GameOfLife\CellState;
use GameOfLife\Grid;
use GameOfLife\GridGenerator;

/**
 * Class RandomGenerator
 * @package GameOfLife\GridGenerator
 */
class RandomGenerator implements GridGenerator
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
     * @return Grid
     */
    public function generate()
    {
        $numberOfRows = mt_rand($this->minRows, $this->maxRows);
        $numberOfColumns = mt_rand($this->minCols, $this->maxCols);

        $grid = new Grid($numberOfRows, $numberOfColumns);

        for ($posY = 0; $posY < $numberOfRows; $posY++) {
            for ($posX = 0; $posX < $numberOfColumns; $posX++) {
                $randomState = mt_rand(CellState::DEAD, CellState::ALIVE);
                $grid->setCell(new Cell($randomState, $posX, $posY));
            }
        }

        return $grid;
    }
} 