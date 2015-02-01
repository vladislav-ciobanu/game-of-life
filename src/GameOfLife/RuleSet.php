<?php

namespace GameOfLife;

/**
 * Interface RuleSet
 *
 * @package GameOfLife
 */
interface RuleSet
{
    /**
     * @param int $cellState
     * @param int $nbOfLivingNeighbours
     * @return int
     */
    public function apply($cellState, $nbOfLivingNeighbours);
} 