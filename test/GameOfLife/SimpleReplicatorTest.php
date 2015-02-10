<?php

namespace GameOfLife;

/**
 * Class SimpleReplicatorTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\SimpleReplicator
 */
class SimpleReplicatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleReplicator
     */
    private $testSubject;

    /**
     * @var RuleSet|\PHPUnit_Framework_MockObject_MockObject
     */
    private $ruleSetMock;

    /**
     * @var NeighboursCounter|\PHPUnit_Framework_MockObject_MockObject
     */
    private $neighboursCounterMock;

    /**
     * @var GridManager|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gridManagerMock;


    protected function setUp()
    {
        $this->ruleSetMock = $this->getMock('\GameOfLife\RuleSet');
        $this->neighboursCounterMock = $this->getMock('\GameOfLife\NeighboursCounter');
        $this->gridManagerMock = $this->getMock('\GameOfLife\GridManager');
        $this->testSubject = new SimpleReplicator(
            $this->ruleSetMock,
            $this->neighboursCounterMock,
            $this->gridManagerMock
        );
    }

    public function testClassImplementsExpectedInterface()
    {
        $this->assertInstanceOf('GameOfLife\SimpleReplicator', $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\SimpleReplicator::__construct
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->ruleSetMock, "ruleSet", $this->testSubject);
        $this->assertAttributeSame($this->neighboursCounterMock, "neighboursCounter", $this->testSubject);
    }



    /**
     * @covers \GameOfLife\SimpleReplicator::replicate
     * @uses \GameOfLife\Cell
     * @uses \GameOfLife\Grid
     */
    public function testReplicateWorksAsExpected()
    {
        $grid = new Grid();
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));

        $this->neighboursCounterMock->expects($this->once())->method('countLiving')
                ->with($this->isInstanceOf('\GameOfLife\Grid'), $this->isInstanceOf('\GameOfLife\Cell'))
                ->will($this->returnValue(0));

        $this->ruleSetMock->expects($this->once())->method('apply')
                ->with($this->logicalOr(CellState::DEAD, CellState::ALIVE), 0)
                ->will($this->returnValue(CellState::ALIVE));

        $this->gridManagerMock->expects($this->once())->method('addBorder')->with($grid);

        $replicatedGrid = $this->testSubject->replicate($grid);

        $this->assertEquals(1, $replicatedGrid->getNumberOfRows());
        $this->assertEquals(1, $replicatedGrid->getNumberOfColumns());

        /* @var Cell[] $line */
        foreach ($replicatedGrid->getCells() as $line) {
            foreach ($line as $cell) {
                $this->assertTrue($cell->isAlive());
            }
        }
    }
}
