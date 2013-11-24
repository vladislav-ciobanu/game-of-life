<?php

namespace GameOfLife;

/**
 * Class SimpleReplicator
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
     * @param RuleSet $ruleSet
     * @param NeighboursCounter $neighboursCounter
     */
    public function __construct(RuleSet $ruleSet, NeighboursCounter $neighboursCounter)
    {
        $this->ruleSet = $ruleSet;
        $this->neighboursCounter = $neighboursCounter;
    }

    /**
     * @param Grid $grid
     * @return Grid
     */
    public function replicate(Grid $grid)
    {
        $newGrid = new Grid();

        /* @var Cell[] $line */
        foreach ($grid as $line) {
            foreach ($line as $cell) {
                $nbLivingNeighbours = $this->neighboursCounter->countLiving($grid, $cell);
                $newCellState = $this->ruleSet->apply($cell->getState(), $nbLivingNeighbours);
                $cell = new Cell($newCellState, $cell->getPositionX(), $cell->getPositionY());
                $newGrid->setCell($cell);
            }
        }

        return $newGrid;
    }
} 