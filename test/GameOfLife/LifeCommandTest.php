<?php

namespace GameOfLife;

use GameOfLife\Grid\Generator\PatternGridGenerator;
use GameOfLife\Grid\Generator\RandomGridGenerator;
use GameOfLife\Grid\Grid;
use GameOfLife\Util\GamePatternsLoader;

/**
 * Class LifeCommandTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\LifeCommand
 */
class LifeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LifeCommand
     */
    private $testSubject;

    /**
     * @var Life|\PHPUnit_Framework_MockObject_MockObject
     */
    private $lifeMock;

    /**
     * @var PatternGridGenerator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $patternGridGeneratorMock;

    /**
     * @var RandomGridGenerator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $randomGridGeneratorMock;

    /**
     * @var GamePatternsLoader|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gamePatternsLoaderMock;

    /**
     * @var \Symfony\Component\Console\Input\InputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $inputMock;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $outputMock;

    /**
     * @var Grid|\PHPUnit_Framework_MockObject_MockObject
     */
    private $gridMock;


    protected function setUp()
    {
        $this->lifeMock = $this->getMock('\GameOfLife\Life', array(), array(), '', false);
        $this->patternGridGeneratorMock = $this
                ->getMock('\GameOfLife\Grid\Generator\PatternGridGenerator', array(), array(), '', false);
        $this->randomGridGeneratorMock = $this->getMock('\GameOfLife\Grid\Generator\RandomGridGenerator');
        $this->gamePatternsLoaderMock = $this
                ->getMock('\GameOfLife\Util\GamePatternsLoader', array(), array(), '', false);
        $this->inputMock = $this->getMock('\Symfony\Component\Console\Input\InputInterface');
        $this->outputMock = $this->getMock('\Symfony\Component\Console\Output\OutputInterface');
        $this->gridMock = $this->getMock('\GameOfLife\Grid\Grid');

        $this->gamePatternsLoaderMock->expects($this->once())->method('getPatternNames')->willReturn(array('testName'));
        
        $this->testSubject = new LifeCommand(
            $this->lifeMock,
            $this->patternGridGeneratorMock,
            $this->randomGridGeneratorMock,
            $this->gamePatternsLoaderMock
        );
    }



    /**
     * @covers \GameOfLife\LifeCommand::execute
     * @uses \GameOfLife\Grid\Grid
     */
    public function testExecuteWorksAsExpectedWithRandomGridGenerator()
    {
        $this->expectInputMock(LifeCommand::DEFAULT_PATTERN);

        $this->randomGridGeneratorMock->expects($this->once())
                ->method('generate')
                ->with(null, LifeCommand::DEFAULT_MAX_ROW_LIMIT, LifeCommand::DEFAULT_MAX_COLUMN_LIMIT)
                ->willReturn($this->gridMock);

        $this->testSubject->run($this->inputMock, $this->outputMock);
    }

    /**
     * @covers \GameOfLife\LifeCommand::execute
     * @uses \GameOfLife\Grid\Grid
     */
    public function testExecuteWorksAsExpectedWithPatternGridGenerator()
    {
        $pattern = 'testPattern';
        $this->expectInputMock($pattern);

        $this->patternGridGeneratorMock->expects($this->once())
                ->method('generate')
                ->with('testPattern', LifeCommand::DEFAULT_MAX_ROW_LIMIT, LifeCommand::DEFAULT_MAX_COLUMN_LIMIT)
                ->willReturn($this->gridMock);

        $this->testSubject->run($this->inputMock, $this->outputMock);
    }

    private function expectInputMock($pattern)
    {
        $this->inputMock->expects($this->at(3))->method('getOption')->with(LifeCommand::OPTION_PATTERN)
                ->willReturn($pattern);
        $this->inputMock->expects($this->at(4))->method('getOption')->with(LifeCommand::OPTION_MAX_ROW_LIMIT)
                ->willReturn(LifeCommand::DEFAULT_MAX_ROW_LIMIT);
        $this->inputMock->expects($this->at(5))->method('getOption')->with(LifeCommand::OPTION_MAX_COLUMN_LIMIT)
                ->willReturn(LifeCommand::DEFAULT_MAX_COLUMN_LIMIT);
        $this->inputMock->expects($this->at(6))->method('getOption')
                ->with(LifeCommand::OPTION_MAX_NUMBER_OF_GENERATIONS)->willReturn(5);
    }
}
