<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 13:00
 */

namespace Soa\Daemon\Data\Values;

use Soa\Daemon\Data\KeyValueInterface;

abstract class AbstractKeyValue implements KeyValueInterface
{
    /**
     * @var array
     */
    protected $keys = array();

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @return array
     */
    public function getNames()
    {
        return array(
            'keys' => $this->keys,
            'values' => $this->values
        );
    }

    /**
     * @return string
     */
    public function getRandomKey()
    {
        return $this->keys[$this->getRandomElement($this->keys)];
    }

    /**
     * @return mixed
     */
    public function getRandomValue()
    {
        return $this->values[$this->getRandomElement($this->values)];
    }

    /**
     * @param array $source
     * @return int
     */
    private function getRandomElement(array $source)
    {
        $sourceCount = count($source);
        return rand(0, $sourceCount-1);
    }

    /**
     * @return int
     */
    abstract public function getCount();

    /**
     * @return int
     */
    abstract public function getSubCount();

}