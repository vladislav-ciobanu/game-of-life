<?php
namespace GameOfLife;

/**
 * Class ConsoleGridPrinterTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\ConsoleGridPrinter
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
        $this->assertInstanceOf('GameOfLife\GridPrinter', $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\ConsoleGridPrinter::__construct
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame($this->outputMock, "output", $this->testSubject);
        $this->assertAttributeSame(100000, "displayDelay", $this->testSubject);
    }

    /**
     * @covers  \GameOfLife\ConsoleGridPrinter::doPrint
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
