<?php

namespace GameOfLife\Grid;

/**
 * Class Cell
 *
 * @package GameOfLife\Grid
 */
class Cell
{
    /**
     * @var int
     */
    private $state;

    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @param int $state
     * @param int $positionX
     * @param int $positionY
     */
    public function __construct($state, $positionX, $positionY)
    {
        $this->state     = $state;
        $this->positionX = (int) $positionX;
        $this->positionY = (int) $positionY;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * @return int
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * @return int
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * @return bool
     */
    public function isAlive()
    {
        return CellState::ALIVE === $this->state;
    }
}
