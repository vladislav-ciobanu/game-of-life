<?php

namespace GameOfLife\Grid\Generator;

use GameOfLife\Grid\Grid;
use GameOfLife\Util\GamePatternsLoader;

/**
 * Class PatternGridGeneratorTest
 *
 * @package GameOfLife\Grid\Generator
 * @covers GameOfLife\Grid\Generator\PatternGridGenerator
 */
class PatternGridGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PatternGridGenerator
     */
    private $testSubject;

    /**
     * @var GamePatternsLoader|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gamePatternsLoaderMock;

    /**
     * @var ArrayGridGenerator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $arrayGridGeneratorMock;


    protected function setUp()
    {
        $this->gamePatternsLoaderMock = $this->getMock(
            '\GameOfLife\Util\GamePatternsLoader',
            array(),
            array(),
            '',
            false
        );

        $this->arrayGridGeneratorMock = $this->getMock(
            '\GameOfLife\Grid\Generator\ArrayGridGenerator',
            array(),
            array(),
            '',
            false
        );

        $this->testSubject = new PatternGridGenerator($this->gamePatternsLoaderMock, $this->arrayGridGeneratorMock);
    }



    /**
     * @expectedException \InvalidArgumentException
     * @covers GameOfLife\Grid\Generator\PatternGridGenerator::generate
     */
    public function testGenerateWhenInvalidPatternThenThrowsInvalidArgumentException()
    {
        $this->gamePatternsLoaderMock->expects($this->once())->method('getGamePatterns')->willReturn(array());
        $this->testSubject->generate('invalidPattern');
    }

    /**
     * @covers GameOfLife\Grid\Generator\PatternGridGenerator::generate
     * @uses \GameOfLife\Grid\Grid
     */
    public function testGenerateWhenPatternFoundThenGenerateGrid()
    {
        $patternName = 'testPattern';
        $patternData = array(array(1, 0));
        $maxRowLimit = 3;
        $maxColumnLimit = 4;
        $grid = new Grid($maxRowLimit, $maxColumnLimit);

        $this->gamePatternsLoaderMock->expects($this->once())
                ->method('getGamePatterns')->willReturn(array($patternName => $patternData));
        $this->arrayGridGeneratorMock->expects($this->once())
                ->method('generate')->with($patternData, $maxRowLimit, $maxColumnLimit)->willReturn($grid);

        $generatedGrid = $this->testSubject->generate($patternName, $maxRowLimit, $maxColumnLimit);
        $this->assertEquals($grid, $generatedGrid);
    }
}
