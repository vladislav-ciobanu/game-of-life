<?php

namespace GameOfLife;

/**
 * Class GridGeneratorFactory
 *
 * @package GameOfLife
 */
class GridGeneratorFactory
{
    /**
     *
     * @param string $generatorName
     * @return GridGenerator
     * @throws \InvalidArgumentException
     */
    public static function getGridGeneratorInstance($generatorName)
    {
        if (empty($generatorName)) {
            throw new \InvalidArgumentException('No generator specified');
        }
        
        $generatorClass = 'GameOfLife\\GridGenerator\\' . ucfirst($generatorName) . 'Generator';
        
        if (!class_exists($generatorClass)) {
            throw new \InvalidArgumentException('Invalid generator ' . $generatorName);
        }

        return new $generatorClass();
    }
}
