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
     * @param null|int $maxRowLimit
     * @param null|int $maxColumnLimit
     * @return Grid
     */
    public function generate($maxRowLimit = null, $maxColumnLimit = null);
} 