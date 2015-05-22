<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 19.05.15
 * Time: 20:53
 */

namespace Soa\Daemon\Data\Generator;

use Soa\Daemon\Data\StaticKeyInterface;


class Ticker implements GeneratorInterface {

    private $names;

    private $mockedData = array();

    public function __construct(StaticKeyInterface $names)
    {
        $this->names = $names;
        $this->generate();
    }

    private function generate()
    {
        foreach ($this->names->getKeys() as $key) {
            $this->mockedData[] = array(
                'ident' => $key,
                'value' => $this->names->getRandomValue()
            );
        }

    }

    public function getData()
    {
        return $this->mockedData;
    }
}