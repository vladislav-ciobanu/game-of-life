<?php

namespace GameOfLife\Grid;

/**
 * Class CellTest
 *
 * @package GameOfLife\Grid
 * @covers \GameOfLife\Grid\Cell
 */
class CellTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $cellState;

    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @var Cell
     */
    private $testSubject;


    protected function setUp()
    {
        $this->cellState = CellState::ALIVE;
        $this->positionX = 2;
        $this->positionY = 3;

        $this->testSubject = new Cell($this->cellState, $this->positionX, $this->positionY);
    }

    /**
     * @covers  \GameOfLife\Grid\Cell::__construct
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->cellState, "state", $this->testSubject);
        $this->assertAttributeSame($this->positionX, "positionX", $this->testSubject);
        $this->assertAttributeSame($this->positionY, "positionY", $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\Grid\Cell::getState
     */
    public function testGetStateReturnsExpectedCellState()
    {
        $this->assertEquals($this->cellState, $this->testSubject->getState());
    }

    /**
     * @covers  \GameOfLife\Grid\Cell::getPositionX
     */
    public function testGetPositionXReturnsExpectedXPosition()
    {
        $this->assertEquals($this->positionX, $this->testSubject->getPositionX());
    }

    /**
     * @covers  \GameOfLife\Grid\Cell::getPositionY
     */
    public function testGetPositionYReturnsExpectedYPosition()
    {
        $this->assertEquals($this->positionY, $this->testSubject->getPositionY());
    }

    /**
     * @covers  \GameOfLife\Grid\Cell::isAlive
     */
    public function testIsAliveWorksAsExpected()
    {
        $this->assertTrue($this->testSubject->isAlive());
    }
}
