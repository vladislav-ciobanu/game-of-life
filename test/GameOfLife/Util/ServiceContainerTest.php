<?php

namespace GameOfLife\Util;

/**
 * Class ServiceContainerTest
 *
 * @package GameOfLife\Util
 * @covers GameOfLife\Util\ServiceContainer
 */
class ServiceContainerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers GameOfLife\Util\ServiceContainer::getService
     */
    public function testGetService()
    {
        $service = ServiceContainer::getService('conwayRuleSet');
        $this->assertInstanceOf('\GameOfLife\ConwayRuleSet', $service);

        $service = ServiceContainer::getService('simpleNeighboursCounter');
        $this->assertInstanceOf('\GameOfLife\SimpleNeighboursCounter', $service);
    }
}
