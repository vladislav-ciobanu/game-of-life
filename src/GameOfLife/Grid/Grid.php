<?php

namespace GameOfLife\Grid;

/**
 * Class Grid
 *
 * @package GameOfLife\Grid
 */
class Grid
{
    /**
     * @var Cell[][]
     */
    private $cells = array();

    /**
     * @var int
     */
    private $maxRowLimit;

    /**
     * @var int
     */
    private $maxColumnLimit;

    /**
     * @param null|int $maxRowLimit
     * @param null|int $maxColumnLimit
     */
    public function __construct($maxRowLimit = null, $maxColumnLimit = null)
    {
        $this->maxRowLimit    = $maxRowLimit;
        $this->maxColumnLimit = $maxColumnLimit;
    }

    /**
     * @return int
     */
    public function getMaxRowLimit()
    {
        return $this->maxRowLimit;
    }

    /**
     * @return int
     */
    public function getMaxColumnLimit()
    {
        return $this->maxColumnLimit;
    }

    /**
     * @param Cell $cell
     */
    public function setCell(Cell $cell)
    {
        $this->cells[$cell->getPositionY()][$cell->getPositionX()] = $cell;
    }

    /**
     * @param $positionX
     * @param $positionY
     * @return bool
     */
    public function hasCell($positionX, $positionY)
    {
        return isset($this->cells[$positionY][$positionX]);
    }

    /**
     * @param $positionX
     * @param $positionY
     */
    public function removeCell($positionX, $positionY)
    {
        if (!$this->hasCell($positionX, $positionY)) {
            throw new \InvalidArgumentException(
                sprintf('Unknown grid cell at position [%s %s]', $positionX, $positionY)
            );
        }

        unset($this->cells[$positionY][$positionX]);

        if (empty($this->cells[$positionY])) {
            unset($this->cells[$positionY]);
        }
    }

    /**
     * @param $positionX
     * @param $positionY
     * @return Cell
     */
    public function getCell($positionX, $positionY)
    {
        return $this->cells[$positionY][$positionX];
    }

    /**
     * @return int|null
     */
    public function getMinPositionX()
    {
        return $this->getNumberOfRows() ? key(reset($this->cells)) : null;
    }

    /**
     * @return int|null
     */
    public function getMaxPositionX()
    {
        return $this->getNumberOfRows() ? $this->getMinPositionX() + $this->getNumberOfColumns() - 1 : null;
    }

    /**
     * @return int|null
     */
    public function getMinPositionY()
    {
        if (!$this->getNumberOfRows()) {
            return null;
        }

        reset($this->cells);

        return key($this->cells);
    }

    /**
     * @return int|null
     */
    public function getMaxPositionY()
    {
        return $this->getNumberOfRows() ? $this->getMinPositionY() + $this->getNumberOfRows() - 1 : null;
    }

    /**
     * @return int
     */
    public function getNumberOfRows()
    {
        return count($this->cells);
    }

    /**
     * @return int
     */
    public function getNumberOfColumns()
    {
        $row = reset($this->cells);
        return $row === false ? 0 : count($row);
    }

    public function sortRowsByPosition()
    {
        ksort($this->cells);
    }

    public function sortColumnsByPosition()
    {
        foreach ($this->cells as &$row) {
            ksort($row);
        }
    }

    /**
     * @param \Closure $cellClosure
     * @param \Closure $lineClosure
     */
    public function forEachCell(\Closure $cellClosure, \Closure $lineClosure = null)
    {
        if (null === $lineClosure) {
            $lineClosure = function () {

            };
        }

        /* @var Cell[] $line */
        foreach ($this->cells as $line) {
            foreach ($line as $cell) {
                $cellClosure($cell);
            }

            $lineClosure();
        }
    }
}
