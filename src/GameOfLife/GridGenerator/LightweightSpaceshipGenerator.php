<?php

namespace GameOfLife\GridGenerator;

/**
 * Class LightweightSpaceshipGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class LightweightSpaceshipGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 1, 0, 0, 1),
            array(1, 0, 0, 0, 0),
            array(1, 0, 0, 0, 1),
            array(1, 1, 1, 1, 0)
        );

        parent::__construct($data);
    }
}