<?php
namespace GameOfLife;

/**
 * Class CliGridPrinterTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\CliGridPrinter
 */
class CliGridPrinterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CliGridPrinter
     */
    private $testSubject;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $outputMock;

    protected function setUp()
    {
        $this->outputMock = $this->getMock('\Symfony\Component\Console\Output\OutputInterface');
        $this->testSubject = new CliGridPrinter($this->outputMock);
    }

    /**
     * @covers  \GameOfLife\CliGridPrinter::doPrint
     * @uses    \GameOfLife\Cell
     * @uses    \GameOfLife\Grid
     */
    public function testDoPrintWorksAsExpected()
    {
        $grid = new Grid();
        $grid->setCell(new Cell(CellState::DEAD, 0, 0));
        $grid->setCell(new Cell(CellState::ALIVE, 0, 1));
        $grid->setCell(new Cell(CellState::ALIVE, 1, 0));
        $grid->setCell(new Cell(CellState::DEAD, 1, 1));

        $expectedOutput = PHP_EOL . '. O ' . PHP_EOL . 'O . ' . PHP_EOL . PHP_EOL;
        $this->outputMock->expects($this->once())->method('write')->with($expectedOutput);

        $this->testSubject->doPrint($grid);
    }
}
 