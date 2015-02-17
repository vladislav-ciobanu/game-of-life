<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Cell;
use GameOfLife\Grid\CellState;
use GameOfLife\Grid\Grid;

/**
 * Class RandomGridGeneratorTest
 *
 * @package GameOfLife\Grid\Generator
 * @covers GameOfLife\Grid\Generator\RandomGridGenerator
 */
class RandomGridGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RandomGridGenerator
     */
    private $testSubject;


    protected function setUp()
    {
        $this->testSubject = new RandomGridGenerator();
    }

    /**
     * @covers GameOfLife\Grid\Generator\RandomGridGenerator::generate
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testGenerateWhenUsingNoLimitsThenCreateGridWithDefaultLimits()
    {
        $grid = $this->testSubject->generate();
        $this->checkGeneratedGrid(
            $grid,
            RandomGridGenerator::DEFAULT_MAX_ROWS,
            RandomGridGenerator::DEFAULT_MAX_COLUMNS
        );
    }

    /**
     * @covers GameOfLife\Grid\Generator\RandomGridGenerator::generate
     * @uses \GameOfLife\Grid\Grid
     * @uses \GameOfLife\Grid\Cell
     */
    public function testGenerateWhenUsingMaxLimitsThenCreateGridWithTheseLimits()
    {
        $maxRowLimit = 15;
        $maxColumnLimit = 20;
        $grid = $this->testSubject->generate($maxRowLimit, $maxColumnLimit);
        $this->checkGeneratedGrid($grid, $maxRowLimit, $maxColumnLimit);
    }



    /**
     * @param Grid $grid
     * @param $maxRowLimit
     * @param $maxColumnLimit
     */
    private function checkGeneratedGrid(Grid $grid, $maxRowLimit, $maxColumnLimit)
    {
        $this->assertGreaterThanOrEqual(RandomGridGenerator::DEFAULT_MIN_ROWS, $grid->getNumberOfRows());
        $this->assertLessThanOrEqual($maxRowLimit, $grid->getNumberOfRows());
        $this->assertGreaterThanOrEqual(RandomGridGenerator::DEFAULT_MIN_COLUMNS, $grid->getNumberOfColumns());
        $this->assertLessThanOrEqual($maxColumnLimit, $grid->getNumberOfColumns());

        $that = $this;
        $grid->forEachCell(function (Cell $cell) use ($that) {
            $that->assertTrue(in_array($cell->getState(), array(CellState::ALIVE, CellState::DEAD)));
        });
    }
}
