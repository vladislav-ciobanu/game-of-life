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
        return $this->getMinPositionX() + $this->getNumberOfColumns() - 1;
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
        return $this->getMinPositionY() + $this->getNumberOfRows() - 1;
    }

    
    public function addTopRow()
    {
        $this->addRow($this->getMinPositionY() - 1);
    }

    
    public function addBottomRow()
    {
        $this->addRow($this->getMaxPositionY() + 1);
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
        $this->addTopRow();
        $this->addBottomRow();
        $this->addLeftColumn();
        $this->addRightColumn();
    }



    /**
     * @param     $posY
     * @param int  $cellState
     */
    public function addRow($posY, $cellState = CellState::DEAD)
    {
        if (null !== $this->maxRowLimit && $this->getNumberOfRows() >= $this->maxRowLimit) {
            return;
        }
        
        $minPosX = $this->getMinPositionX();
        $maxPosX = $this->getMaxPositionX();

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            $cell = new Cell($cellState, $i, $posY);
            $this->setCell($cell);
        }

        $this->sortRowsByPosition();
    }



    /**
     * @param     $posX
     * @param int  $cellState
     */
    public function addColumn($posX, $cellState = CellState::DEAD)
    {
        if (null !== $this->maxColumnLimit && $this->getNumberOfColumns() >= $this->maxColumnLimit) {
            return;
        }
        
        $minPosY = $this->getMinPositionY();
        $maxPosY = $this->getMaxPositionY();

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            $cell = new Cell($cellState, $posX, $i);
            $this->setCell($cell);
        }

        $this->sortColumnsByPosition();
    }


    public function removeTopRow()
    {
        $this->removeRow($this->getMinPositionY());
    }

    
    public function removeBottomRow()
    {
        $this->removeRow($this->getMaxPositionY());
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
    public function removeRow($posY)
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
        foreach ($this->cells as &$row) {
            if (isset($row[$posX])) {
                unset($row[$posX]);
            }
        }
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
        return count(reset($this->cells));
    }
    
    
    private function sortRowsByPosition()
    {
        ksort($this->cells);
    }

    
    private function sortColumnsByPosition()
    {
        foreach ($this->cells as &$row) {
            ksort($row);
        }
    }
}
