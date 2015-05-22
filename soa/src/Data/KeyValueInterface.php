<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 12:34
 */

namespace Soa\Daemon\Data;


interface KeyValueInterface
{
    /**
     * @return array
     */
    public function getNames();

    /**
     * @return string
     */
    public function getRandomKey();

    /**
     * @return mixed
     */
    public function getRandomValue();

    /**
     * @return int
     */
    public function getCount();

    /**
     * @return int
     */
    public function getSubCount();
}