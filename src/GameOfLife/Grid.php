<?php

namespace GameOfLife;

/**
 * Class Grid
 *
 * @package GameOfLife
 */
class Grid
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
     * @return Cell[][]
     */
    public function getCells()
    {
        return $this->cells;
    }

    public function sortLinesByPosition()
    {
        ksort($this->cells);
    }

    public function sortColumnsByPosition()
    {
        foreach ($this->cells as &$line) {
            ksort($line);
        }
    }

    /**
     * @return int
     */
    public function getMinPositionX()
    {
        return key(reset($this->cells));
    }

    /**
     * @return int
     */
    public function getMaxPositionX()
    {
        return $this->getMinPositionX() + count(reset($this->cells)) - 1;
    }

    /**
     * @return int
     */
    public function getMinPositionY()
    {
        reset($this->cells);

        return key($this->cells);
    }

    /**
     * @return int
     */
    public function getMaxPositionY()
    {
        return $this->getMinPositionY() + count($this->cells) - 1;
    }
} 