<?php

namespace GameOfLife;

/**
 * Class SimpleNeighboursCounter
 * @package GameOfLife
 */
class SimpleNeighboursCounter implements NeighboursCounter
{
    /**
     * @param Grid $grid
     * @param Cell $cell
     * @return int
     */
    public function countLiving(Grid $grid, Cell $cell)
    {
        $nbLives = 0;

        $posY = & $cell->getPositionY();
        $posX = & $cell->getPositionX();

        for ($i = $posY - 1; $i <= $posY + 1; $i++) {
            for ($j = $posX - 1; $j <= $posX + 1; $j++) {
                if ($grid->hasCell($j, $i) && ($posY !== $i || $posX !== $j)) {
                    $nbLives += $grid->getCell($j, $i)->getState();
                }
            }
        }

        return $nbLives;
    }
} 