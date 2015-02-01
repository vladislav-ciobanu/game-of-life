<?php

namespace GameOfLife\GridGenerator;

/**
 * Class TenCellRowGenerator
 *
 * @package GameOfLife\GridGenerator
 */
class TenCellRowGenerator extends ArrayGenerator
{
    public function __construct()
    {
        $data = array(
            array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
        );

        parent::__construct($data);
    }
}
