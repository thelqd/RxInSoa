<?php

namespace Soa\Daemon\Data\Values;


use Soa\Daemon\Data\DynamicKeyInterface;

class AutoComplete implements DynamicKeyInterface {

    /**
     * @var array
     */
    private $values;

    /**
     *
     */
    public function __construct()
    {
        $this->values = array(
            'auto',
            'autohaus',
            'autobahn',
            'automat',
            'amsel',
            'ampel',
            'ampelmaenchen',
            'arm',
            'armband',
            'arme'
        );
    }

    /**
     * @return array
     */
    public function getRandomValues()
    {
        return $this->values;
    }
}