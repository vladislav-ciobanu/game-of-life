<?php

namespace GameOfLife\GridGenerator;

use GameOfLife\CellState;

/**
 * Class TenCellRowGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class TenCellRowGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(
                CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, 
                CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE, CellState::ALIVE),
        );

        parent::__construct($data);
    }
}