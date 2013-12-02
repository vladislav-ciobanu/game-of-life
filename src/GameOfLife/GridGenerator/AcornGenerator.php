<?php

namespace GameOfLife\GridGenerator;

/**
 * Class AcornGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class AcornGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 1, 0, 0, 0, 0, 0),
            array(0, 0, 0, 1, 0, 0, 0),
            array(1, 1, 0, 0, 1, 1, 1),
        );

        parent::__construct($data);
    }
}