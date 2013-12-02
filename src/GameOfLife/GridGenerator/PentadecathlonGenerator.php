<?php

namespace GameOfLife\GridGenerator;

/**
 * Class PentadecathlonGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class PentadecathlonGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 0, 1, 0, 0, 0, 0, 1, 0, 0),
            array(1, 1, 0, 1, 1, 1, 1, 0, 1, 1),
            array(0, 0, 1, 0, 0, 0, 0, 1, 0, 0),
        );

        parent::__construct($data);
    }
}