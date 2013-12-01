<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class SmallExploderGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class SmallExploderGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(CellState::DEAD, CellState::ALIVE, CellState::DEAD),
            array(CellState::ALIVE, CellState::ALIVE, CellState::ALIVE),
            array(CellState::ALIVE, CellState::DEAD, CellState::ALIVE),
            array(CellState::DEAD, CellState::ALIVE, CellState::DEAD),
        );

        parent::__construct($data);
    }
}