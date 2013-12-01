<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class AcornGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class AcornGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::DEAD),
            array(CellState::ALIVE, CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE),
        );

        parent::__construct($data);
    }
}