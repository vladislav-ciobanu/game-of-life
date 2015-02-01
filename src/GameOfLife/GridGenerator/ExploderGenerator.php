<?php

namespace GameOfLife\GridGenerator;

/**
 * Class ExploderGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class ExploderGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(1, 0, 1, 0, 1),
            array(1, 0, 0, 0, 1),
            array(1, 0, 0, 0, 1),
            array(1, 0, 0, 0, 1),
            array(1, 0, 1, 0, 1),
        );

        parent::__construct($data);
    }
}
