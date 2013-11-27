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
     * @param RuleSet           $ruleSet
     * @param NeighboursCounter $neighboursCounter
     */
    public function __construct(RuleSet $ruleSet, NeighboursCounter $neighboursCounter)
    {
        $this->ruleSet           = $ruleSet;
        $this->neighboursCounter = $neighboursCounter;
    }

    /**
     * @param Grid $grid
     * @return Grid
     */
    public function replicate(Grid $grid)
    {
        $minPosY = $grid->getMinPositionY();
        $maxPosY = $grid->getMaxPositionY();
        $minPosX = $grid->getMinPositionX();
        $maxPosX = $grid->getMaxPositionX();

        $newBorderInfo = 0;
        $mask          = $this->getGridBorderBitMask();

        $newGrid = new Grid();

        /* @var Cell[] $line */
        foreach ($grid->getCells() as $posY => $line) {
            foreach ($line as $posX => $cell) {

                $nbLivingNeighbours = $this->neighboursCounter->countLiving($grid, $cell);
                $newCellState       = $this->ruleSet->apply($cell->getState(), $nbLivingNeighbours);

                $cell = new Cell($newCellState, $cell->getPositionX(), $cell->getPositionY());
                $newGrid->setCell($cell);

                if (!$cell->isAlive()) {
                    continue;
                }

                // this variable is later used to check which border do we have to add to the grid
                $newBorderInfo |= ($mask['top'] * ($posY === $minPosY))
                    | ($mask['bottom'] * ($posY === $maxPosY))
                    | ($mask['left'] * ($posX === $minPosX))
                    | ($mask['right'] * ($posX === $maxPosX));
            }
        }

        $this->extendGrid($newGrid, $newBorderInfo);

        return $newGrid;
    }

    /**
     * @return array
     */
    private function getGridBorderBitMask()
    {
        return array(
            'top'    => 1,
            'bottom' => 2,
            'left'   => 4,
            'right'  => 8,
        );

    }

    /**
     * @param Grid $grid
     * @param int  $newBorderInfo
     */
    private function extendGrid(Grid $grid, $newBorderInfo)
    {
        $mask = $this->getGridBorderBitMask();

        // check if a new top line should be added
        ($newBorderInfo & $mask['top']) && $this->addNewLine($grid, $grid->getMinPositionY() - 1);

        // check if a new bottom line should be added
        ($newBorderInfo & $mask['bottom']) && $this->addNewLine($grid, $grid->getMaxPositionY() + 1);

        // check if a new left column should be added
        ($newBorderInfo & $mask['left']) && $this->addNewColumn($grid, $grid->getMinPositionX() - 1);

        // check if a new right column should be added
        ($newBorderInfo & $mask['right']) && $this->addNewColumn($grid, $grid->getMaxPositionX() + 1);
    }

    /**
     * @param Grid $grid
     * @param int  $posY
     */
    private function addNewLine(Grid $grid, $posY)
    {
        $minPosX = $grid->getMinPositionX();
        $maxPosX = $grid->getMaxPositionX();

        for ($i = $minPosX; $i <= $maxPosX; $i++) {
            $cell = new Cell(CellState::DEAD, $i, $posY);
            $grid->setCell($cell);
        }

        $grid->sortLinesByPosition();
    }

    /**
     * @param Grid $grid
     * @param int  $posX
     */
    private function addNewColumn(Grid $grid, $posX)
    {
        $minPosY = $grid->getMinPositionY();
        $maxPosY = $grid->getMaxPositionY();

        for ($i = $minPosY; $i <= $maxPosY; $i++) {
            $cell = new Cell(CellState::DEAD, $posX, $i);
            $grid->setCell($cell);
        }

        $grid->sortColumnsByPosition();
    }
} 