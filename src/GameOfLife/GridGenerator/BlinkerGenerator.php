<?php

namespace GameOfLife\GridGenerator;

/**
 * Class BlinkerGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class BlinkerGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(0, 0, 0, 0, 0),
            array(0, 0, 1, 0, 0),
            array(0, 0, 1, 0, 0),
            array(0, 0, 1, 0, 0),
            array(0, 0, 0, 0, 0),
        );

        parent::__construct($data);
    }
}
