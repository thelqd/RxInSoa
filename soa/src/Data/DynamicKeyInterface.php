<?php

namespace Soa\Daemon\Data;


interface DynamicKeyInterface {

    /**
     * @return array
     */
    public function getRandomValues();
}