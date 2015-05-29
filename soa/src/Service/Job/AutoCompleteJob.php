<?php

namespace Soa\Daemon\Service\Job;

use Soa\Daemon\Data\Values\AutoComplete as Values;
use Soa\Daemon\Data\Generator\AutoComplete as Generator;

class AutoCompleteJob extends JobBase {

    const SLEEP_TIME = 0;

    const QUEUE = '';

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
        return self::SLEEP_TIME;
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