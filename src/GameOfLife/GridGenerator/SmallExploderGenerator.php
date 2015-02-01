<?php

namespace GameOfLife\GridGenerator;

/**
 * Class SmallExploderGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class SmallExploderGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 1, 0),
            array(1, 1, 1),
            array(1, 0, 1),
            array(0, 1, 0),
        );

        parent::__construct($data);
    }
}
