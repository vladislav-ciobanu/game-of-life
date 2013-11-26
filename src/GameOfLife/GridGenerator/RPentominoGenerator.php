<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class RPentominoGenerator
 * @package GameOfLife\GridGenerator
 */
class RPentominoGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::ALIVE, CellState::DEAD),
            array(CellState::DEAD, CellState::ALIVE, CellState::ALIVE, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::ALIVE, CellState::DEAD, CellState::DEAD),
            array(CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD, CellState::DEAD),
        );

        parent::__construct($data);
    }
}