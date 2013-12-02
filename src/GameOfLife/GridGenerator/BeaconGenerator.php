<?php

namespace GameOfLife\GridGenerator;

/**
 * Class BeaconGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class BeaconGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 0, 0, 0, 0, 0),
            array(0, 1, 1, 0, 0, 0),
            array(0, 1, 1, 0, 0, 0),
            array(0, 0, 0, 1, 1, 0),
            array(0, 0, 0, 1, 1, 0),
            array(0, 0, 0, 0, 0, 0),
        );

        parent::__construct($data);
    }
}