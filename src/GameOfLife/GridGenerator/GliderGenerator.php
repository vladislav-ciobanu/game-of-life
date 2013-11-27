<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class GliderGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class GliderGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::DEAD),
            array(CellState::DEAD, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD),
        );

        parent::__construct($data);
    }
}