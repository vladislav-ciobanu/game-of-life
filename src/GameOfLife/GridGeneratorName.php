<?php

namespace GameOfLife;

/**
 * Class GridGeneratorName
 *
 * @package GameOfLife
 */
class GridGeneratorName
{
    const ACORN = 'Acorn';
    const BEACON = 'Beacon';
    const BLINKER = 'Blinker';
    const BLOCK = 'Block';
    const EXPLODER = 'Exploder';
    const GLIDER = 'Glider';
    const GOSPER_GLIDER_GUN = 'GosperGliderGun';
    const LIGHT_WEIGHT_SPACESHIP = 'LightweightSpaceship';
    const PENTADECATHLON = 'Pentadecathlon';
    const RANDOM = 'Random';
    const R_PENTOMINO = 'RPentomino';
    const SMALL_EXPLODER = 'SmallExploder';
    const TEN_CELL_ROW = 'TenCellRow';
    const TOAD = 'Toad';

    /**
     * @return array
     */
    public static function getGridGeneratorNameList()
    {
        return array(
            self::ACORN,
            self::BEACON,
            self::BLINKER,
            self::BLOCK,
            self::EXPLODER,
            self::GLIDER,
            self::GOSPER_GLIDER_GUN,
            self::LIGHT_WEIGHT_SPACESHIP,
            self::PENTADECATHLON,
            self::RANDOM,
            self::R_PENTOMINO,
            self::SMALL_EXPLODER,
            self::TEN_CELL_ROW,
            self::TOAD,
        );
    }
}
