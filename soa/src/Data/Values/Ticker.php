<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 19.05.15
 * Time: 20:46
 */

namespace Soa\Daemon\Data\Values;

use Soa\Daemon\Data\StaticKeyInterface;

class Ticker implements StaticKeyInterface {

    private $keys = array();

    private $values = array();

    public function __construct()
    {
        $this->keys = array(
            'AEG',
            'SIE',
            'DBB',
            'EAS'
        );

        $this->values = array(
            10,
            15,
            20,
            25,
            30,
            35,
            45,
        );

    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function getRandomValue()
    {
        $valueCount = count($this->values);
        return $this->values[rand(0, $valueCount-1)];
    }

    public function getCount()
    {
        return count($this->keys);
    }
}