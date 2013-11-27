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
     * @param int $numberOfLivingNeighbours
     * @return int
     */
    public function apply($cellState, $numberOfLivingNeighbours)
    {
        return (int)(($cellState | $numberOfLivingNeighbours) == 3);
    }
} 