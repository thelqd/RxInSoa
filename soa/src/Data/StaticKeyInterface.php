<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 19.05.15
 * Time: 20:51
 */

namespace Soa\Daemon\Data;


interface StaticKeyInterface {

    /**
     * @return array()
     */
    public function getKeys();

    /**
     * @return mixed
     */
    public function getRandomValue();

    /**
     * @return int
     */
    public function getCount();

}