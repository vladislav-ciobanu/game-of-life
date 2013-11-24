<?php

namespace GameOfLife;

/**
 * Class Grid
 * @package GameOfLife
 */
class Grid implements \IteratorAggregate
{
    /**
     * @var Cell[][]
     */
    private $cells = array();

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
     * @return Cell
     */
    public function getCell($positionX, $positionY)
    {
        return $this->cells[$positionY][$positionX];
    }

    /**
     * @return \RecursiveArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \RecursiveArrayIterator($this->cells);
    }
} 