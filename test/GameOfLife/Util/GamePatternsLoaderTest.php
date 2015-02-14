<?php

namespace GameOfLife\Util;

use Symfony\Component\Finder\Finder;

/**
 * Class ConsoleGridPrinterTest
 *
 * @package GameOfLife
 * @covers  \GameOfLife\Util\GamePatternsLoader
 */
class GamePatternsLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GamePatternsLoader
     */
    private $testSubject;

    /**
     * @var Finder|\PHPUnit_Framework_MockObject_MockObject
     */
    private $finderMock;


    protected function setUp()
    {
        $this->finderMock = $this->getMock('\Symfony\Component\Finder\Finder', array(), array(), '', false);
        $this->testSubject = new GamePatternsLoader($this->finderMock);
    }



    /**
     * @covers \GameOfLife\Util\GamePatternsLoader::getGamePatterns
     */
    public function testGetGamePatternsWorksAsExpected()
    {
        $testPattern = 'testPattern';
        $jsonString = '[[1,0],[0,1]]';
        $expectedGamePatterns = array($testPattern => array(array(1, 0), array(0, 1)));

        $this->expectFinder($testPattern, $jsonString);

        $gamePatterns = $this->testSubject->getGamePatterns();
        $this->assertEquals($expectedGamePatterns, $gamePatterns);

        // check that the next call do not invoke finder and returns the already loaded data
        $gamePatterns = $this->testSubject->getGamePatterns();
        $this->assertEquals($expectedGamePatterns, $gamePatterns);
    }

    /**
     * @covers \GameOfLife\Util\GamePatternsLoader::getPatternNames
     */
    public function testGetPatternNamesWorksAsExpected()
    {
        $expectedPattern = 'testPattern';
        $expectedPatternNames = array($expectedPattern);

        $this->expectFinder($expectedPattern, '[]');

        $patternNames = $this->testSubject->getPatternNames();
        $this->assertEquals($expectedPatternNames, $patternNames);
    }

    /**
     * @param string $testPattern
     * @param string $jsonString
     */
    private function expectFinder($testPattern, $jsonString)
    {
        $this->finderMock->expects($this->once())->method('files')->willReturnSelf();
        $this->finderMock->expects($this->once())->method('in')
                ->with($this->stringEndsWith('src/GameOfLife/Util/../../../'
                        . GamePatternsLoader::GAME_PATTERNS_DIR_SUFFIX))
                ->willReturnSelf();
        $this->finderMock->expects($this->once())->method('name')
                ->with('*.' . GamePatternsLoader::GAME_PATTERNS_FILE_EXT)->willReturnSelf();

        $splFileMock = $this->getMock('\Symfony\Component\Finder\SplFileInfo', array(), array('', '', ''));
        $splFileMock->expects($this->once())->method('getBasename')
                ->with('.' . GamePatternsLoader::GAME_PATTERNS_FILE_EXT)->willReturn($testPattern);
        $splFileMock->expects($this->once())->method('getContents')->willReturn($jsonString);

        $iteratorMock = $this->getMock('\Iterator');
        $iteratorMock->expects($this->at(0))->method('valid')->willReturn(true);
        $iteratorMock->expects($this->at(1))->method('valid')->willReturn(true);
        $iteratorMock->expects($this->once())->method('current')->willReturn($splFileMock);

        $this->finderMock->expects($this->once())->method('getIterator')->willReturn($iteratorMock);
    }
}
