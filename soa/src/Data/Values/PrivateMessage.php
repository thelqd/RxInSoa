<?php

namespace Soa\Daemon\Data\Values;


use Soa\Daemon\Data\StaticKeyInterface;

class PrivateMessage implements StaticKeyInterface {

    /**
     * @var array
     */
    private $sender = array();

    /**
     * @var array
     */
    private $texts = array();

    /**
     * @var array
     */
    private $topics = array();

    /**
     *
     */
    public function __construct()
    {
        $this->keys = array(
            'Peter',
            'Michael',
            'Sabine',
            'Laura'
        );

        $this->topics = array(
            'Schon mitbekommen?',
            'Das musst du sehen',
            'Unser Termin',
            'Hey, wie geht es?'
        );
        $this->texts = array(
            'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ' .
            'Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque' .
            ' penatibus et magnis dis parturient montes, nascetur ridiculus mus.' .
            ' Donec quam felis, ultricies nec, pellentesque eu, pretium quis,' .
            ' sem. Nulla consequat massa quis enim.',
            'Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.' .
            ' In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. ' .
            'Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
            'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate' .
            ' eleifend tellus. Aenean leo ligula, porttitor eu, consequat' .
            ' vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, ' .
            'viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus ' .
            'varius laoreet. Quisque rutrum.',
            'Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ' .
            'ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. ' .
            'Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper ' .
            'libero, sit amet adipiscing sem neque sed ipsum.',
        );

    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Gets a random topic and dynamic text length
     * @return array
     */
    public function getRandomValue()
    {
        $textCount = rand(0, count($this->texts)-1);
        $finalText = '';
        for($i = 0; $i <= $textCount; $i++) {
            $finalText .= $this->texts[$i];
        }

        return array(
            'topic' => $this->topics[rand(0, count($this->topics)-1)],
            'text' => $finalText
        );
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->keys);
    }

}