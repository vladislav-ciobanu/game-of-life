<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Grid;
use GameOfLife\Util\GamePatternsLoader;

/**
 * Class GeneratorFactory
 *
 * @package GameOfLife\Grid\Generator
 */
class PatternGridGenerator implements GridGenerator
{
    /**
     * @var GamePatternsLoader
     */
    private $gamePatternsLoader;

    /**
     * @var ArrayGridGenerator
     */
    private $arrayGridGenerator;


    /**
     * @param GamePatternsLoader $gamePatternsLoader
     * @param ArrayGridGenerator $arrayGridGenerator
     */
    public function __construct(GamePatternsLoader $gamePatternsLoader, ArrayGridGenerator $arrayGridGenerator)
    {
        $this->gamePatternsLoader = $gamePatternsLoader;
        $this->arrayGridGenerator = $arrayGridGenerator;
    }

    /**
     * @param null $sourceData
     * @param null $maxRowLimit
     * @param null $maxColumnLimit
     * @return Grid
     */
    public function generate($sourceData = null, $maxRowLimit = null, $maxColumnLimit = null)
    {
        if (empty($sourceData)) {
            throw new \InvalidArgumentException('No pattern specified');
        }

        $patternName = strtolower($sourceData);

        $gamePatterns = $this->gamePatternsLoader->getGamePatterns();

        if (!isset($gamePatterns[$patternName])) {
            throw new \InvalidArgumentException('Invalid pattern ' . $patternName);
        }

        return $this->arrayGridGenerator->generate($gamePatterns[$patternName], $maxRowLimit, $maxColumnLimit);
    }
}
