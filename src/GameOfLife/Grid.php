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

    public function addTopLine()
    {
        $this->addLine($this->getMinPositionY() - 1);
    }

    public function addBottomLine()
    {
        $this->addLine($this->getMaxPositionY() + 1);
    }

    public function addLeftColumn()
    {
        $this->addColumn($this->getMinPositionX() - 1);
    }

    public function addRightColumn()
    {
        $this->addColumn($this->getMaxPositionX() + 1);
    }

    public function addBorder()
    {
        $this->addTopLine();
        $this->addBottomLine();
        $this->addLeftColumn();
        $this->addRightColumn();
    }

    /**
     * @param int $posY
     * @param int $cellState
     */
    public function addLine($posY, $cellState = CellState::DEAD)
    {
        $minPosX = $this->getMinPositionX();
        $maxPosX = $this->getMaxPositionX();

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            $cell = new Cell($cellState, $i, $posY);
            $this->setCell($cell);
        }

        $this->sortLinesByPosition();
    }

    /**
     * @param int $posX
     * @param int $cellState
     */
    public function addColumn($posX, $cellState = CellState::DEAD)
    {
        $minPosY = $this->getMinPositionY();
        $maxPosY = $this->getMaxPositionY();

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            $cell = new Cell($cellState, $posX, $i);
            $this->setCell($cell);
        }

        $this->sortColumnsByPosition();
    }


    public function removeTopLine()
    {
        $this->removeLine($this->getMinPositionY());
    }

    public function removeBottomLine()
    {
        $this->removeLine($this->getMaxPositionY());
    }

    public function removeLeftColumn()
    {
        $this->removeColumn($this->getMinPositionX());
    }

    public function removeRightColumn()
    {
        $this->removeColumn($this->getMaxPositionX());
    }

    /**
     * @param int $posY
     */
    public function removeLine($posY)
    {
        if (isset($this->cells[$posY])) {
            unset($this->cells[$posY]);
        }
    }

    /**
     * @param int $posX
     */
    public function removeColumn($posX)
    {
        foreach ($this->cells as &$line) {
            if (isset($line[$posX])) {
                unset($line[$posX]);
            }
        }
    }

    private function sortLinesByPosition()
    {
        ksort($this->cells);
    }

    private function sortColumnsByPosition()
    {
        foreach ($this->cells as &$line) {
            ksort($line);
        }
    }
}