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

    const MESSAGE_CHANCE = 20;

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
        //we won't create a new message every run
        if(self::MESSAGE_CHANCE >= rand(1, 100)) {
            $senderArray = $this->names->getKeys();
            $sender = $senderArray[rand(0, $this->names->getCount() - 1)];
            $message = $this->names->getRandomValue();
            $this->mockedData[] = array(
                'new' => true,
                'sender' => $sender,
                'topic' => $message['topic'],
                'text' => $message['text']
            );
        } else {
            $this->mockedData[] = array(
                'new' => false
            );
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