<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 12:28
 */

namespace Soa\Daemon\Data\Generator;

class FullRandom implements GeneratorInterface
{

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var int
     */
    private $subCount = 0;

    /**
     * @var array
     */
    private $mockedData;

    /**
     * @var KeyValueInterface
     */
    private $names;

    public function __construct(KeyValueInterface $names)
    {
        $this->names = $names;
        $this->count = rand(1, $this->names->getCount());
        $this->subCount = $this->names->getSubCount();
        $this->generate();
    }

    /**
     *
     */
    private function generate()
    {
        $this->mockedData = array();
        for ($i=0; $i < $this->count; $i++) {
            $subCount = rand(1, $this->subCount);
            $subArray = array();
            for($j=0; $j < $subCount; $j++) {
                $subArray[$this->names->getRandomKey()] = $this->names->getRandomValue();
            }
            $this->mockedData[] = $subArray;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->mockedData;
    }
}