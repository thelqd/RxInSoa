<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 19.05.15
 * Time: 20:52
 */

namespace Soa\Daemon\Data\Generator;


interface GeneratorInterface {

    /**
     * @return array()
     */
    public function getData();
}