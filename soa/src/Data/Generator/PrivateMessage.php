<?php

namespace Soa\Daemon\Data\Generator;

use Soa\Daemon\Data\StaticKeyInterface;

class PrivateMessage implements GeneratorInterface {

    /**
     * @var StaticKeyInterface
     */
    private $names;

    /**
     * @var array
     */
    private $mockedData = array();

    /**
     * @param StaticKeyInterface $names
     */
    public function __construct(StaticKeyInterface $names)
    {
        $this->names = $names;
        $this->generate();
    }

    /**
     *
     */
    private function generate()
    {
        $senderArray = $this->names->getKeys();
        $sender = $senderArray[rand(0, $this->names->getCount()-1)];
        $message = $this->names->getRandomValue();
        $this->mockedData[] = array(
            'sender' => $sender,
            'topic' => $message['topic'],
            'text' => $message['text']
        );
    }
    /**
     * @return array
     */
    public function getData()
    {
        return $this->mockedData;
    }
}