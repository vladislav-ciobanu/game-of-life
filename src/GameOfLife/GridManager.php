<?php

namespace GameOfLife;

/**
 * Class GridManager
 *
 * @package GameOfLife
 */
class GridManager
{
    /**
     * @param Grid $grid
     * @param      $posY
     * @param int  $cellState
     */
    public function addRow(Grid $grid, $posY, $cellState = CellState::DEAD)
    {
        if (null !== $grid->getMaxRowLimit() && $grid->getNumberOfRows() >= $grid->getMaxRowLimit()) {
            return;
        }

        if (null === ($minPosX = $grid->getMinPositionX())) {
            $minPosX = 0;
        }

        $maxPosX = $grid->getMaxPositionX();

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            $cell = new Cell($cellState, $i, $posY);
            $grid->setCell($cell);
        }

        $grid->sortRowsByPosition();
    }

    /**
     * @param Grid $grid
     * @param      $posX
     * @param int  $cellState
     */
    public function addColumn(Grid $grid, $posX, $cellState = CellState::DEAD)
    {
        if (null !== $grid->getMaxColumnLimit() && $grid->getNumberOfColumns() >= $grid->getMaxColumnLimit()) {
            return;
        }

        if (null === ($minPosY = $grid->getMinPositionY())) {
            $minPosY = 0;
        }

        $maxPosY = $grid->getMaxPositionY();

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            $cell = new Cell($cellState, $posX, $i);
            $grid->setCell($cell);
        }

        $grid->sortColumnsByPosition();
    }

    /**
     * @param Grid $grid
     */
    public function addTopRow(Grid $grid)
    {
        if (!$grid->getNumberOfRows()) {
            return;
        }

        $this->addRow($grid, $grid->getMinPositionY() - 1);
    }

    /**
     * @param Grid $grid
     */
    public function addBottomRow(Grid $grid)
    {
        if (!$grid->getNumberOfRows()) {
            return;
        }

        $this->addRow($grid, $grid->getMaxPositionY() + 1);
    }

    /**
     * @param Grid $grid
     */
    public function addLeftColumn(Grid $grid)
    {
        if (!$grid->getNumberOfRows()) {
            return;
        }

        $this->addColumn($grid, $grid->getMinPositionX() - 1);
    }

    /**
     * @param Grid $grid
     */
    public function addRightColumn(Grid $grid)
    {
        if (!$grid->getNumberOfRows()) {
            return;
        }

        $this->addColumn($grid, $grid->getMaxPositionX() + 1);
    }

    /**
     * @param Grid $grid
     */
    public function removeTopRow(Grid $grid)
    {
        $this->removeRow($grid, $grid->getMinPositionY());
    }

    /**
     * @param Grid $grid
     */
    public function removeBottomRow(Grid $grid)
    {
        $this->removeRow($grid, $grid->getMaxPositionY());
    }

    /**
     * @param Grid $grid
     */
    public function removeLeftColumn(Grid $grid)
    {
        $this->removeColumn($grid, $grid->getMinPositionX());
    }

    /**
     * @param Grid $grid
     */
    public function removeRightColumn(Grid $grid)
    {
        $this->removeColumn($grid, $grid->getMaxPositionX());
    }

    /**
     * @param Grid $grid
     * @param int  $posY
     */
    public function removeRow(Grid $grid, $posY)
    {
        if (null === ($minPosX = $grid->getMinPositionX())) {
            return;
        }

        $maxPosX = $grid->getMaxPositionX();

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            if ($grid->hasCell($i, $posY)) {
                $grid->removeCell($i, $posY);
            }
        }
    }

    /**
     * @param Grid $grid
     * @param int  $posX
     */
    public function removeColumn(Grid $grid, $posX)
    {
        if (null === ($minPosY = $grid->getMinPositionY())) {
            return;
        }

        $maxPosY = $grid->getMaxPositionY();

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            if ($grid->hasCell($posX, $i)) {
                $grid->removeCell($posX, $i);
            }
        }
    }

    /**
     * @param Grid $grid
     */
    public function addBorder(Grid $grid)
    {
        $this->addTopRow($grid);
        $this->addBottomRow($grid);
        $this->addLeftColumn($grid);
        $this->addRightColumn($grid);
    }

    /**
     * @param Grid $grid
     */
    public function removeBorder(Grid $grid)
    {
        $this->removeTopRow($grid);
        $this->removeBottomRow($grid);
        $this->removeLeftColumn($grid);
        $this->removeRightColumn($grid);
    }
}
