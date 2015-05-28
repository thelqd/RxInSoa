<?php

namespace Soa\Daemon\Service\Job;

use Soa\Daemon\Data\Generator\PrivateMessage as Generator;
use Soa\Daemon\Data\Values\PrivateMessage as Values;

class PrivateMessageJob extends JobBase {
    /**
     * @var string
     */
    const QUEUE = 'pm';

    /**
     * @param int $runtime
     */
    public function __construct($runtime)
    {
        parent::__construct($runtime);
    }

    /**
     * @return int
     */
    public function getSleep()
    {
        return rand(2, 5);
    }

    /**
     * @return string
     */
    public function getQueue()
    {
        return self::QUEUE;
    }

    /**
     *
     */
    public function generateData()
    {
        $generator = new Generator(new Values());
        $this->response->pushData(
            $generator->getData()
        );
    }
}
