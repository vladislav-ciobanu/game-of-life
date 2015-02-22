<?php

namespace GameOfLife\Grid;

/**
 * Class GridManager
 *
 * @package GameOfLife\Grid
 */
class GridManager
{
    /**
     * @param Grid $grid
     * @param int  $posY
     * @param int  $cellState
     */
    public function addRow(Grid $grid, $posY, $cellState = CellState::DEAD)
    {
        if (null !== $grid->getMaxRowLimit() && $grid->getNumberOfRows() >= $grid->getMaxRowLimit()) {
            return;
        }

        $this->processGridUnit(
            $grid,
            $grid->getMinPositionX(),
            $grid->getMaxPositionX(),
            function ($posX) use ($cellState, $posY) {
                return new Cell($cellState, $posX, $posY);
            }
        );

        $grid->sortRowsByPosition();
    }

    /**
     * @param Grid $grid
     * @param int  $posX
     * @param int  $cellState
     */
    public function addColumn(Grid $grid, $posX, $cellState = CellState::DEAD)
    {
        if (null !== $grid->getMaxColumnLimit() && $grid->getNumberOfColumns() >= $grid->getMaxColumnLimit()) {
            return;
        }

        $this->processGridUnit(
            $grid,
            $grid->getMinPositionY(),
            $grid->getMaxPositionY(),
            function ($posY) use ($cellState, $posX) {
                return new Cell($cellState, $posX, $posY);
            }
        );

        $grid->sortColumnsByPosition();
    }

    /**
     * @param Grid     $grid
     * @param int      $gridMinPosition
     * @param int      $maxPos
     * @param \Closure $buildCellCallback
     */
    private function processGridUnit(Grid $grid, $gridMinPosition, $maxPos, \Closure $buildCellCallback)
    {
        if (null === ($minPos = $gridMinPosition)) {
            $minPos = 0;
        }

        for ($i = $minPos; $i <= $maxPos; $i++) {
            $grid->setCell($buildCellCallback($i));
        }
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
