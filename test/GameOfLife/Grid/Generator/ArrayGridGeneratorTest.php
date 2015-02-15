<?php
namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Cell;
use GameOfLife\Grid\CellState;
use GameOfLife\Grid\Grid;

/**
 * Class ArrayGridGeneratorTest
 *
 * @package GameOfLife\Grid\Generator
 * @covers \GameOfLife\Grid\Generator\ArrayGridGenerator
 */
class ArrayGridGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayGridGenerator
     */
    private $testSubject;


    protected function setUp()
    {
        $this->testSubject = new ArrayGridGenerator();
    }

    /**
     * @uses \GameOfLife\Grid\CellState
     * @uses \GameOfLife\Grid\Cell
     * @uses \GameOfLife\Grid\Grid
     */
    public function testGenerateWorksAsExpected()
    {
        $maxRowLimit = 10;
        $maxColumnLimit = 10;

        $generatedGrid = $this->testSubject->generate(array(array(1, 0)), $maxRowLimit, $maxColumnLimit);
        $grid = new Grid($maxRowLimit, $maxColumnLimit);
        $grid->setCell(new Cell(CellState::ALIVE, 0, 0));
        $grid->setCell(new Cell(CellState::DEAD, 1, 0));

        $this->assertEquals($grid, $generatedGrid);
    }
}
