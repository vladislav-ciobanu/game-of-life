<?php
namespace GameOfLife;

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
     * @var GridGenerator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gridGeneratorMock;

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
        $this->gridGeneratorMock = $this->getMock('\GameOfLife\GridGenerator');
        $this->replicatorMock = $this->getMock('\GameOfLife\Replicator');
        $this->gridPrinterMock = $this->getMock('\GameOfLife\GridPrinter');
        $this->gridMock = $this->getMock('\GameOfLife\Grid');

        $this->testSubject = new Life($this->gridGeneratorMock, $this->replicatorMock, $this->gridPrinterMock);
    }

    /**
     * @covers  \GameOfLife\Life::__construct
     * @uses \GameOfLife\Grid
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->gridGeneratorMock, "gridGenerator", $this->testSubject);
        $this->assertAttributeSame($this->replicatorMock, "replicator", $this->testSubject);
        $this->assertAttributeSame($this->gridPrinterMock, "gridPrinter", $this->testSubject);
    }


    /**
     * @covers \GameOfLife\Life::play
     * @uses \GameOfLife\Grid
     */
    public function testPlayWhenMaxNbOfGenerationsIsZeroThenDoNotReplicate()
    {
        $maxRowLimit = 2;
        $maxColumnLimit = 2;

        $this->expectGridGenerator($maxRowLimit, $maxColumnLimit);
        $this->expectGridPrinter(0, $this->gridMock);
        $this->replicatorMock->expects($this->never())->method('replicate');

        $this->testSubject->play(0, $maxRowLimit, $maxColumnLimit);
    }


    /**
     * @covers \GameOfLife\Life::play
     * @uses \GameOfLife\Grid
     */
    public function testPlayWhenMaxNbOfGenerationsGreaterThanZeroThenReplicate()
    {
        $maxRowLimit = 2;
        $maxColumnLimit = 2;
        $replicatedGrid1 = $this->getMock('\GameOfLife\Grid');
        $replicatedGrid2 = $this->getMock('\GameOfLife\Grid');

        $this->expectGridGenerator($maxRowLimit, $maxColumnLimit);
        $this->expectGridPrinter(0, $this->gridMock);
        $this->expectReplicator(0, $replicatedGrid1);
        $this->expectGridPrinter(1, $replicatedGrid1);
        $this->expectReplicator(1, $replicatedGrid2);
        $this->expectGridPrinter(2, $replicatedGrid2);

        $this->testSubject->play(2, $maxRowLimit, $maxColumnLimit);
    }


    /**
     * @param int $maxRowLimit
     * @param int $maxColumnLimit
     */
    private function expectGridGenerator($maxRowLimit, $maxColumnLimit)
    {
        $this->gridGeneratorMock->expects($this->once())->method('generate')
                ->with($maxRowLimit, $maxColumnLimit)
                ->will($this->returnValue($this->gridMock));
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
