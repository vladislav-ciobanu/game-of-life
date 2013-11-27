<?php

namespace GameOfLife;

/**
 * Interface GridGenerator
 *
 * @package GameOfLife
 */
interface GridGenerator
{

    /**
     * @return Grid
     */
    public function generate();
} 