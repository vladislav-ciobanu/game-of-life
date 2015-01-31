<?php

namespace GameOfLife;

/**
 * Class CellTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\Cell
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


    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->cellState, "state", $this->testSubject);
        $this->assertAttributeSame($this->positionX, "positionX", $this->testSubject);
        $this->assertAttributeSame($this->positionY, "positionY", $this->testSubject);
    }

    public function testGetStateReturnsExpectedCellState()
    {
        $this->assertEquals($this->cellState, $this->testSubject->getState());
    }

    public function testGetPositionXReturnsExpectedXPosition()
    {
        $this->assertEquals($this->positionX, $this->testSubject->getPositionX());
    }

    public function testGetPositionYReturnsExpectedYPosition()
    {
        $this->assertEquals($this->positionY, $this->testSubject->getPositionY());
    }

    public function testIsAliveWorksAsExpected()
    {
        $this->assertTrue($this->testSubject->isAlive());
    }
} 