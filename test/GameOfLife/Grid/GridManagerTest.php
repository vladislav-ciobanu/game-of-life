<?php

namespace GameOfLife\Grid;

use GameOfLife\Grid\Generator\RandomGridGenerator;

/**
 * Class GridManagerTest
 *
 * @package GameOfLife\Grid
 * @covers  \GameOfLife\Grid\GridManager
 */
class GridManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GridManager
     */
    private $testSubject;


    protected function setUp()
    {
        $this->testSubject = new GridManager();
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddRowWorksAsExpected()
    {
        $grid = new Grid(1, 1);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));

        $initialGrid = clone $grid;
        $this->testSubject->addRow($grid, 1);

        $this->assertEquals($initialGrid, $grid);

        $grid = new Grid(1, 1);
        $this->testSubject->addRow($grid, 0);
        $this->assertEquals(1, $grid->getNumberOfRows());
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddColumnWorksAsExpected()
    {
        $grid = new Grid(1, 1);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));

        $initialGrid = clone $grid;
        $this->testSubject->addColumn($grid, 1);

        $this->assertEquals($initialGrid, $grid);

        $grid = new Grid(1, 1);
        $this->testSubject->addColumn($grid, 0);
        $this->assertEquals(1, $grid->getNumberOfColumns());
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addTopRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddTopRowWorksAsExpected()
    {
        $grid = new Grid(5, 5);

        $initialGrid = clone $grid;
        $this->testSubject->addTopRow($grid);

        $this->assertEquals($initialGrid, $grid);

        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->testSubject->addTopRow($grid);
        $this->assertEquals(2, $grid->getNumberOfRows());
        $this->assertTrue($grid->hasCell(0, -1));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addBottomRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddBottomRowWorksAsExpected()
    {
        $grid = new Grid(5, 5);

        $initialGrid = clone $grid;
        $this->testSubject->addBottomRow($grid);

        $this->assertEquals($initialGrid, $grid);

        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->testSubject->addBottomRow($grid);
        $this->assertEquals(2, $grid->getNumberOfRows());
        $this->assertTrue($grid->hasCell(0, 1));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addLeftColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddLeftColumnWorksAsExpected()
    {
        $grid = new Grid(5, 5);

        $initialGrid = clone $grid;
        $this->testSubject->addLeftColumn($grid);

        $this->assertEquals($initialGrid, $grid);

        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->testSubject->addLeftColumn($grid);
        $this->assertEquals(2, $grid->getNumberOfColumns());
        $this->assertTrue($grid->hasCell(-1, 0));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addRightColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddRightColumnWorksAsExpected()
    {
        $grid = new Grid(5, 5);

        $initialGrid = clone $grid;
        $this->testSubject->addRightColumn($grid);

        $this->assertEquals($initialGrid, $grid);

        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->testSubject->addRightColumn($grid);
        $this->assertEquals(2, $grid->getNumberOfColumns());
        $this->assertTrue($grid->hasCell(1, 0));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveRowWorksAsExpected()
    {
        $grid = new Grid(1, 1);
        $initialGrid = clone $grid;
        $this->testSubject->removeRow($grid, 0);

        $this->assertEquals($initialGrid, $grid);

        $grid = new Grid(1, 1);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->assertEquals(1, $grid->getNumberOfRows());
        $this->testSubject->removeRow($grid, 0);
        $this->assertEquals(0, $grid->getNumberOfRows());
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveColumnWorksAsExpected()
    {
        $grid = new Grid(1, 1);
        $initialGrid = clone $grid;
        $this->testSubject->removeColumn($grid, 0);

        $this->assertEquals($initialGrid, $grid);

        $grid = new Grid(1, 1);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->assertEquals(1, $grid->getNumberOfColumns());
        $this->testSubject->removeColumn($grid, 0);
        $this->assertEquals(0, $grid->getNumberOfColumns());
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeTopRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveTopRowWorksAsExpected()
    {
        $grid = new Grid(2, 2);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $grid->setCell(new Cell(CellState::DEAD, 0, 1));

        $this->assertEquals(2, $grid->getNumberOfRows());

        $this->testSubject->removeTopRow($grid);

        $this->assertEquals(1, $grid->getNumberOfRows());
        $this->assertTrue($grid->hasCell(0, 1));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeBottomRow
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveBottomRowWorksAsExpected()
    {
        $grid = new Grid(2, 2);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $grid->setCell(new Cell(CellState::DEAD, 0, 1));

        $this->assertEquals(2, $grid->getNumberOfRows());

        $this->testSubject->removeBottomRow($grid);

        $this->assertEquals(1, $grid->getNumberOfRows());
        $this->assertTrue($grid->hasCell(0, 0));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeLeftColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveLeftColumnWorksAsExpected()
    {
        $grid = new Grid(2, 2);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $grid->setCell(new Cell(CellState::DEAD, 1, 0));

        $this->assertEquals(2, $grid->getNumberOfColumns());

        $this->testSubject->removeLeftColumn($grid);

        $this->assertEquals(1, $grid->getNumberOfColumns());
        $this->assertTrue($grid->hasCell(1, 0));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeRightColumn
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testRemoveRightColumnWorksAsExpected()
    {
        $grid = new Grid(2, 2);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $grid->setCell(new Cell(CellState::DEAD, 1, 0));

        $this->assertEquals(2, $grid->getNumberOfColumns());

        $this->testSubject->removeRightColumn($grid);

        $this->assertEquals(1, $grid->getNumberOfColumns());
        $this->assertTrue($grid->hasCell(0, 0));
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::addBorder
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testAddBorderWorksAsExpected()
    {
        $grid = new Grid(10, 10);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $this->assertEquals(1, $grid->getNumberOfRows());
        $this->assertEquals(1, $grid->getNumberOfColumns());

        $this->testSubject->addBorder($grid);
        $this->assertEquals(3, $grid->getNumberOfRows());
        $this->assertEquals(3, $grid->getNumberOfColumns());
    }

    /**
     * @covers \GameOfLife\Grid\GridManager::removeBorder
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     * @uses \GameOfLife\Grid\Generator\RandomGridGenerator
     */
    public function testRemoveBorderWorksAsExpected()
    {
        $randomGridGenerator = new RandomGridGenerator();
        $grid = $randomGridGenerator->generate(null, 3, 3);

        $this->assertEquals(3, $grid->getNumberOfRows());
        $this->assertEquals(3, $grid->getNumberOfColumns());

        $this->testSubject->removeBorder($grid);
        $this->assertEquals(1, $grid->getNumberOfRows());
        $this->assertEquals(1, $grid->getNumberOfColumns());
    }
}
