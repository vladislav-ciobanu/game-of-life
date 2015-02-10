<?php

namespace GameOfLife;

/**
 * Class SimpleReplicator
 *
 * @package GameOfLife
 */
class SimpleReplicator implements Replicator
{
    /**
     * @var RuleSet
     */
    private $ruleSet;

    /**
     * @var NeighboursCounter
     */
    private $neighboursCounter;

    /**
     * @var GridManager
     */
    private $gridManager;

    /**
     * @param RuleSet           $ruleSet
     * @param NeighboursCounter $neighboursCounter
     * @param GridManager       $gridManager
     */
    public function __construct(RuleSet $ruleSet, NeighboursCounter $neighboursCounter, GridManager $gridManager)
    {
        $this->ruleSet           = $ruleSet;
        $this->neighboursCounter = $neighboursCounter;
        $this->gridManager       = $gridManager;
    }

    /**
     * @param Grid $grid
     * @return Grid
     */
    public function replicate(Grid $grid)
    {
        $clonedGrid = clone $grid;
        $this->gridManager->addBorder($clonedGrid);

        $newGrid = new Grid($clonedGrid->getMaxRowLimit(), $clonedGrid->getMaxColumnLimit());

        /* @var Cell[] $line */
        foreach ($clonedGrid->getCells() as $line) {
            foreach ($line as $cell) {
                $nbLivingNeighbours = $this->neighboursCounter->countLiving($clonedGrid, $cell);
                $newCellState       = $this->ruleSet->apply($cell->getState(), $nbLivingNeighbours);

                $cell = new Cell($newCellState, $cell->getPositionX(), $cell->getPositionY());
                $newGrid->setCell($cell);
            }
        }

        $this->adjustGridTopBottomLines($newGrid);
        $this->adjustGridLeftRightColumns($newGrid);

        return $newGrid;
    }

    /**
     * @param Grid $grid
     */
    private function adjustGridLeftRightColumns(Grid $grid)
    {
        $minPosX = $grid->getMinPositionX();
        $maxPosX = $grid->getMaxPositionX();
        $minPosY = $grid->getMinPositionY();
        $maxPosY = $grid->getMaxPositionY();

        $removeLeftColumn  = true;
        $removeRightColumn = true;

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            if ($this->isCellAlive($grid, $minPosX, $i)) {
                $removeLeftColumn = false;
            }

            if ($this->isCellAlive($grid, $maxPosX, $i)) {
                $removeRightColumn = false;
            }
        }

        $removeLeftColumn && $this->gridManager->removeLeftColumn($grid);
        $removeRightColumn && $this->gridManager->removeRightColumn($grid);
    }

    /**
     * @param Grid $grid
     */
    private function adjustGridTopBottomLines(Grid $grid)
    {
        $minPosX = $grid->getMinPositionX();
        $maxPosX = $grid->getMaxPositionX();
        $minPosY = $grid->getMinPositionY();
        $maxPosY = $grid->getMaxPositionY();

        $removeTopLine     = true;
        $removeBottomLine  = true;

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            if ($this->isCellAlive($grid, $i, $minPosY)) {
                $removeTopLine = false;
            }

            if ($this->isCellAlive($grid, $i, $maxPosY)) {
                $removeBottomLine = false;
            }
        }

        $removeTopLine && $this->gridManager->removeTopRow($grid);
        $removeBottomLine && $this->gridManager->removeBottomRow($grid);
    }

    /**
     * @param Grid $grid
     * @param int  $posX
     * @param int  $posY
     * @return bool
     */
    private function isCellAlive(Grid $grid, $posX, $posY)
    {
        return $grid->hasCell($posX, $posY) && $grid->getCell($posX, $posY)->isAlive();
    }
}
