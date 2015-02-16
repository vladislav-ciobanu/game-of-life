<?php

namespace GameOfLife\Util;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class GamePatternsLoader
 *
 * @package GameOfLife
 */
class GamePatternsLoader
{
    const GAME_PATTERNS_DIR_SUFFIX = 'resources/game-patterns/';
    const GAME_PATTERNS_FILE_EXT = 'json';

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var \int[][]
     */
    private $gamePatterns = array();


    /**
     * @param Finder $finder
     */
    public function __construct($finder)
    {
        $this->finder = $finder;
    }

    /**
     * @return \string[]\int[][]
     */
    public function getGamePatterns()
    {
        $this->loadGamePatterns();

        return $this->gamePatterns;
    }

    /**
     * @return \string[]
     */
    public function getPatternNames()
    {
        return array_keys($this->getGamePatterns());
    }

    private function loadGamePatterns()
    {
        if (!empty($this->gamePatterns)) {
            return;
        }

        $this->finder->files()
            ->in($this->getGamePatternsDir())
            ->name('*.' . self::GAME_PATTERNS_FILE_EXT);

        /* @var SplFileInfo $file */
        foreach ($this->finder as $file) {
            $patternName = $file->getBasename('.' . self::GAME_PATTERNS_FILE_EXT);
            $this->gamePatterns[$patternName] = json_decode($file->getContents());
        }
    }

    /**
     * @return string
     */
    private function getGamePatternsDir()
    {
        return dirname(__FILE__) . '/../../../' . self::GAME_PATTERNS_DIR_SUFFIX;
    }
}
