<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Grid;

/**
 * Interface GridGenerator
 *
 * @package GameOfLife\Grid\Generator
 */
interface GridGenerator
{

    /**
     * @param mixed|null $sourceData
     * @param int|null $maxRowLimit
     * @param int|null $maxColumnLimit
     * @return Grid
     */
    public function generate($sourceData = null, $maxRowLimit = null, $maxColumnLimit = null);
}
