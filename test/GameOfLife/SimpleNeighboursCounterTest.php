<?php

namespace GameOfLife;

/**
 * Class SimpleNeighboursCounterTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\SimpleNeighboursCounter
 */
class SimpleNeighboursCounterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleNeighboursCounter
     */
    private $testSubject;
    
    
    protected function setUp()
    {
        $this->testSubject = new SimpleNeighboursCounter();
    }

    public function testClassImplementsExpectedInterface()
    {
        $this->assertInstanceOf('GameOfLife\NeighboursCounter', $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\SimpleNeighboursCounter::countLiving
     * @uses    \GameOfLife\Cell
     * @uses    \GameOfLife\Grid
     */
    public function testCountLivingWhenGridEmptyReturnsZeroNeighbours()
    {
        $result = $this->testSubject->countLiving(new Grid(), new Cell(0, 0, 0));
        $this->assertEmpty($result);
    }


    /**
     * @covers  \GameOfLife\SimpleNeighboursCounter::countLiving
     * @uses    \GameOfLife\Cell
     * @uses    \GameOfLife\Grid
     */
    public function testCountLivingReturnExpectedNumberOfNeighbours()
    {
        $cellToCheck = new Cell(CellState::DEAD, 0, 0);
        $grid = new Grid();
        $grid->setCell($cellToCheck);
        $grid->addBottomRow();
        $grid->addRightColumn();
        $grid->setCell(new Cell(CellState::ALIVE, 1, 1));
        $grid->setCell(new Cell(CellState::ALIVE, 0, 1));
        
        $result = $this->testSubject->countLiving($grid, $cellToCheck);
        $this->assertEquals($result, 2);
    }    
}