<?php

namespace GameOfLife\Grid;

/**
 * Class GridTest
 *
 * @package GameOfLife\Grid
 * @covers  \GameOfLife\Grid\Grid
 */
class GridTest extends \PHPUnit_Framework_TestCase
{
    const MAX_ROW_LIMIT = 10;
    const MAX_COLUMN_LIMIT = 10;

    /**
     * @var Grid
     */
    private $testSubject;


    protected function setUp()
    {
        $this->testSubject = new Grid(self::MAX_ROW_LIMIT, self::MAX_COLUMN_LIMIT);
    }

    /**
     * @covers \GameOfLife\Grid\Grid::__construct
     */
    public function testConstructorWorks()
    {
        $this->assertAttributeSame(self::MAX_ROW_LIMIT, "maxRowLimit", $this->testSubject);
        $this->assertAttributeSame(self::MAX_COLUMN_LIMIT, "maxColumnLimit", $this->testSubject);
    }



    /**
     * @covers \GameOfLife\Grid\Grid::getMaxRowLimit
     */
    public function testGetMaxRowLimitWorksAsExpected()
    {
        $this->assertEquals(self::MAX_ROW_LIMIT, $this->testSubject->getMaxRowLimit());
    }



    /**
     * @covers \GameOfLife\Grid\Grid::getMaxColumnLimit
     */
    public function testGetMaxColumnLimitWorksAsExpected()
    {
        $this->assertEquals(self::MAX_COLUMN_LIMIT, $this->testSubject->getMaxColumnLimit());
    }



    /**
     * @covers \GameOfLife\Grid\Grid::setCell
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testSetCellWorksAsExpected()
    {
        $this->assertAttributeEquals(array(), 'cells', $this->testSubject);

        $cell = new Cell(CellState::ALIVE, 0, 1);
        $this->testSubject->setCell($cell);
        $this->assertAttributeEquals(
            array($cell->getPositionY() => array($cell->getPositionX() => $cell)),
            'cells',
            $this->testSubject
        );
    }



    /**
     * @covers \GameOfLife\Grid\Grid::hasCell
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testHasCellWorksAsExpected()
    {
        $cell = new Cell(CellState::ALIVE, 0, 1);
        $this->assertFalse($this->testSubject->hasCell($cell->getPositionX(), $this->testSubject->getMaxPositionY()));

        $this->testSubject->setCell($cell);
        $this->assertTrue($this->testSubject->hasCell($cell->getPositionX(), $this->testSubject->getMaxPositionY()));
    }



    /**
     * @covers \GameOfLife\Grid\Grid::removeCell
     * @expectedException \InvalidArgumentException
     */
    public function testRemoveCellWhenInvalidPositionThenThrowsException()
    {
        $this->testSubject->removeCell(0, 0);
    }



    /**
     * @covers \GameOfLife\Grid\Grid::removeCell
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testRemoveCellWorksAsExpected()
    {
        $positionX = 0;
        $positionY = 1;
        $cell      = new Cell(CellState::ALIVE, $positionX, $positionY);
        $this->testSubject->setCell($cell);
        $this->testSubject->removeCell($positionX, $positionY);

        $this->assertAttributeEquals(array(), 'cells', $this->testSubject);
    }



    /**
     * @covers \GameOfLife\Grid\Grid::getCell
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetCellWorksAsExpected()
    {
        $positionX = 0;
        $positionY = 1;
        $cell      = new Cell(CellState::ALIVE, $positionX, $positionY);
        $this->testSubject->setCell($cell);
        $this->assertEquals($cell, $this->testSubject->getCell($positionX, $positionY));
    }



    /**
     * @covers \GameOfLife\Grid\Grid::getNumberOfRows
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetNumberOfRowsWorksAsExpected()
    {
        $this->assertEquals(0, $this->testSubject->getNumberOfRows());
        $cell = new Cell(CellState::ALIVE, 0, 1);
        $this->testSubject->setCell($cell);
        $this->assertEquals(1, $this->testSubject->getNumberOfRows());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::getNumberOfColumns
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetNumberOfColumnsWorksAsExpected()
    {
        $this->assertEquals(0, $this->testSubject->getNumberOfColumns());
        $cell = new Cell(CellState::ALIVE, 0, 1);
        $this->testSubject->setCell($cell);
        $this->assertEquals(1, $this->testSubject->getNumberOfColumns());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::getMinPositionX
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetMinPositionXWorksAsExpected()
    {
        $this->assertEquals(null, $this->testSubject->getMinPositionX());
        $cell = new Cell(CellState::ALIVE, 2, 1);
        $this->testSubject->setCell($cell);
        $this->assertEquals(2, $this->testSubject->getMinPositionX());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::getMinPositionY
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetMinPositionYWorksAsExpected()
    {
        $this->assertEquals(null, $this->testSubject->getMinPositionY());
        $cell = new Cell(CellState::ALIVE, 2, 3);
        $this->testSubject->setCell($cell);
        $this->assertEquals(3, $this->testSubject->getMinPositionY());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::getMaxPositionX
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetMaxPositionXWorksAsExpected()
    {
        $this->assertEquals(null, $this->testSubject->getMaxPositionX());
        $cell = new Cell(CellState::ALIVE, 2, 3);
        $this->testSubject->setCell($cell);
        $this->assertEquals(2, $this->testSubject->getMaxPositionX());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::getMaxPositionY
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testGetMaxPositionYWorksAsExpected()
    {
        $this->assertEquals(null, $this->testSubject->getMaxPositionY());
        $cell = new Cell(CellState::ALIVE, 2, 3);
        $this->testSubject->setCell($cell);
        $this->assertEquals(3, $this->testSubject->getMaxPositionY());
    }

    /**
     * @covers \GameOfLife\Grid\Grid::sortRowsByPosition
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testSortRowsByPositionWorksAsExpected()
    {
        $cell1 = new Cell(CellState::ALIVE, 5, 6);
        $cell2 = new Cell(CellState::DEAD, 2, 3);

        $this->testSubject->setCell($cell1);
        $this->testSubject->setCell($cell2);

        $this->testSubject->sortRowsByPosition();

        $this->assertAttributeEquals(
            array(3 => array(2 => $cell2), 6 => array(5 => $cell1)),
            'cells',
            $this->testSubject
        );
    }

    /**
     * @covers \GameOfLife\Grid\Grid::sortColumnsByPosition
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testSortColumnsByPositionWorksAsExpected()
    {
        $cell1 = new Cell(CellState::ALIVE, 5, 6);
        $cell2 = new Cell(CellState::DEAD, 2, 6);

        $this->testSubject->setCell($cell1);
        $this->testSubject->setCell($cell2);

        $this->testSubject->sortColumnsByPosition();

        $this->assertAttributeEquals(
            array(6 => array(2 => $cell2, 5 => $cell1)),
            'cells',
            $this->testSubject
        );
    }

    /**
     * @covers \GameOfLife\Grid\Grid::forEachCell
     * @uses   \GameOfLife\Grid\CellState
     * @uses   \GameOfLife\Grid\Cell
     */
    public function testForEachCellWorksAsExpected()
    {
        $cell = new Cell(CellState::ALIVE, 0, 0);
        $this->testSubject->setCell($cell);
        $test = $this;

        $this->testSubject->forEachCell(function (Cell $gridCell) use ($cell, $test) {
            $test->assertEquals($cell, $gridCell);
        });
    }
}
