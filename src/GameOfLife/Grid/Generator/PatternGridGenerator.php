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
     * @inheritdoc
     */
    public function generate($sourceData, $maxRowLimit = null, $maxColumnLimit = null)
    {
        $patternName = strtolower($sourceData);

        $gamePatterns = $this->gamePatternsLoader->getGamePatterns();

        if (!isset($gamePatterns[$patternName])) {
            throw new \InvalidArgumentException('Invalid pattern ' . $patternName);
        }

        return $this->arrayGridGenerator->generate($gamePatterns[$patternName], $maxRowLimit, $maxColumnLimit);
    }
}
