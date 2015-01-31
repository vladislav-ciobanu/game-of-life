<?php

namespace GameOfLife;

/**
 * Class ConwayRuleSetTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\ConwayRuleSet
 */
class ConwayRuleSetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConwayRuleSet
     */
    private $testSubject;
    
    
    protected function setUp()
    {
        $this->testSubject = new ConwayRuleSet();
    }

    public function testClassImplementsExpectedInterface()
    {
        $this->assertInstanceOf('GameOfLife\ConwayRuleSet', $this->testSubject);
    }
    

    /**
     * @param int $cellState
     * @param int $numberOfNeighbours
     * @param int $expectedNewCellState
     * 
     * @dataProvider dataProvider
     * @covers  \GameOfLife\ConwayRuleSet::apply
     */
    public function testApplyBehavesAsExpected($cellState, $numberOfNeighbours, $expectedNewCellState)
    {
        $newCellState = $this->testSubject->apply($cellState, $numberOfNeighbours);
        $this->assertEquals($expectedNewCellState, $newCellState);
    }
    
  
    /**
     * @return array
     */
    public function dataProvider()
    {
        return array(
            array(CellState::ALIVE, 0, CellState::DEAD),
            array(CellState::ALIVE, 1, CellState::DEAD),
            array(CellState::ALIVE, 2, CellState::ALIVE),
            array(CellState::ALIVE, 3, CellState::ALIVE),
            array(CellState::ALIVE, 4, CellState::DEAD),
            array(CellState::ALIVE, 5, CellState::DEAD),
            array(CellState::ALIVE, 6, CellState::DEAD),
            array(CellState::ALIVE, 7, CellState::DEAD),
            array(CellState::ALIVE, 8, CellState::DEAD),
            array(CellState::DEAD, 0, CellState::DEAD),
            array(CellState::DEAD, 1, CellState::DEAD),
            array(CellState::DEAD, 2, CellState::DEAD),
            array(CellState::DEAD, 3, CellState::ALIVE),
            array(CellState::DEAD, 4, CellState::DEAD),
            array(CellState::DEAD, 5, CellState::DEAD),
            array(CellState::DEAD, 6, CellState::DEAD),
            array(CellState::DEAD, 7, CellState::DEAD),
            array(CellState::DEAD, 8, CellState::DEAD),            
        );
    }
} 