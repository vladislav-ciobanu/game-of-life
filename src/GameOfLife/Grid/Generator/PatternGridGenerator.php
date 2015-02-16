<?php

namespace GameOfLife\Grid\Generator;

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
        $gamePatterns = $this->gamePatternsLoader->getGamePatterns();

        if (!isset($gamePatterns[$sourceData])) {
            throw new \InvalidArgumentException('Invalid pattern ' . $sourceData);
        }

        return $this->arrayGridGenerator->generate($gamePatterns[$sourceData], $maxRowLimit, $maxColumnLimit);
    }
}
