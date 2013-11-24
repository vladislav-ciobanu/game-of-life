<?php

namespace GameOfLife;

/**
 * Interface RuleSet
 * @package GameOfLife
 */
interface RuleSet
{
    /**
     * @param int $cellState
     * @param int $numberOfLivingNeighbours
     * @return int
     */
    public function apply($cellState, $numberOfLivingNeighbours);
} 