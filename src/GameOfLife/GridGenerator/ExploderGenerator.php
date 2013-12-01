<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class ExploderGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class ExploderGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(CellState::ALIVE, CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::ALIVE),
            array(CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::ALIVE),
            array(CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::ALIVE),
            array(CellState::ALIVE, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::ALIVE),
            array(CellState::ALIVE, CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::ALIVE),
        );

        parent::__construct($data);
    }
}