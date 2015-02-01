<?php

namespace GameOfLife;

/**
 * Class ConwayRuleSet
 *
 * @package GameOfLife
 */
class ConwayRuleSet implements RuleSet
{
    /**
     * @param int $cellState
     * @param int $nbOfLivingNeighbours
     * @return int
     */
    public function apply($cellState, $nbOfLivingNeighbours)
    {
        return (int)(($cellState | $nbOfLivingNeighbours) == 3);
    }
}
