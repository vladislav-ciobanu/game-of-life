<?php
namespace GameOfLife;

use GameOfLife\Grid\Grid;
use GameOfLife\Grid\GridPrinter;

/**
 * Class LifeTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\Life
 */
class LifeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Life
     */
    private $testSubject;

    /**
     * @var Replicator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $replicatorMock;

    /**
     * @var GridPrinter|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gridPrinterMock;

    /**
     * @var Grid|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gridMock;


    protected function setUp()
    {
        $this->replicatorMock = $this->getMock('\GameOfLife\Replicator');
        $this->gridPrinterMock = $this->getMock('\GameOfLife\Grid\GridPrinter');
        $this->gridMock = $this->getMock('\GameOfLife\Grid\Grid');

        $this->testSubject = new Life($this->replicatorMock, $this->gridPrinterMock);
    }

    /**
     * @covers  \GameOfLife\Life::__construct
     * @uses \GameOfLife\Grid\Grid
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->replicatorMock, "replicator", $this->testSubject);
        $this->assertAttributeSame($this->gridPrinterMock, "gridPrinter", $this->testSubject);
    }


    /**
     * @covers \GameOfLife\Life::play
     * @uses \GameOfLife\Grid\Grid
     */
    public function testPlayWhenMaxNbOfGenerationsIsZeroThenDoNotReplicate()
    {
        $this->expectGridPrinter(0, $this->gridMock);
        $this->replicatorMock->expects($this->never())->method('replicate');

        $this->testSubject->play($this->gridMock, 0);
    }


    /**
     * @covers \GameOfLife\Life::play
     * @uses \GameOfLife\Grid\Grid
     */
    public function testPlayWhenMaxNbOfGenerationsGreaterThanZeroThenReplicate()
    {
        $replicatedGrid1 = $this->getMock('\GameOfLife\Grid\Grid');
        $replicatedGrid2 = $this->getMock('\GameOfLife\Grid\Grid');

        $this->expectGridPrinter(0, $this->gridMock);
        $this->expectReplicator(0, $replicatedGrid1);
        $this->expectGridPrinter(1, $replicatedGrid1);
        $this->expectReplicator(1, $replicatedGrid2);
        $this->expectGridPrinter(2, $replicatedGrid2);

        $this->testSubject->play($this->gridMock, 2);
    }


    /**
     * @param int $invocationIndex
     * @param Grid|\PHPUnit_Framework_MockObject_MockObject $gridMock
     */
    private function expectGridPrinter($invocationIndex, $gridMock)
    {
        $this->gridPrinterMock->expects($this->at($invocationIndex))->method('doPrint')->with($gridMock);
    }


    /**
     * @param int $invocationIndex
     * @param Grid|\PHPUnit_Framework_MockObject_MockObject $replicatedGrid
     */
    private function expectReplicator($invocationIndex, $replicatedGrid)
    {
        $this->replicatorMock->expects($this->at($invocationIndex))->method('replicate')
                ->with($this->gridMock)->will($this->returnValue($replicatedGrid));
    }
}
