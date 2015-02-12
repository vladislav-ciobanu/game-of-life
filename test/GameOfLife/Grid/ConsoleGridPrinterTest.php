<?php
namespace GameOfLife\Grid;

/**
 * Class ConsoleGridPrinterTest
 *
 * @package GameOfLife\Grid
 * @covers  \GameOfLife\Grid\ConsoleGridPrinter
 */
class ConsoleGridPrinterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConsoleGridPrinter
     */
    private $testSubject;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $outputMock;

    protected function setUp()
    {
        $this->outputMock = $this->getMock('\Symfony\Component\Console\Output\OutputInterface');
        $this->testSubject = new ConsoleGridPrinter($this->outputMock);
    }

    public function testClassImplementsExpectedInterface()
    {
        $this->assertInstanceOf('GameOfLife\Grid\GridPrinter', $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\Grid\ConsoleGridPrinter::__construct
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->outputMock, "output", $this->testSubject);
        $this->assertAttributeSame(100000, "displayDelay", $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\Grid\ConsoleGridPrinter::doPrint
     * @uses    \GameOfLife\Grid\Cell
     * @uses    \GameOfLife\Grid\Grid
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
