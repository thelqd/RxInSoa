<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 13:16
 */

namespace Soa\Daemon\Data\Values;


class Random extends AbstractKeyValue
{
    /**
     * @const int
     */
    const LIMIT_COUNT = 30;

    /**
     * @const int
     */
    const LIMIT_SUB_COUNT = 15;

    public function __construct()
    {
        $this->keys = array(
            'value',
            'value1',
            'value2',
            'value3'
        );

        $this->values = array(
            0,
            1,
            'test',
            'bla',
            2.3
        );
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return self::LIMIT_COUNT;
    }

    public function getSubCount()
    {
        return self::LIMIT_SUB_COUNT;
    }
}