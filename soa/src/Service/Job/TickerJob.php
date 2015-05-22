<?php

namespace Soa\Daemon\Service\Job;

use Soa\Daemon\Data\Generator\Ticker as TickerGenerator;
use Soa\Daemon\Data\Values\Ticker as TickerValues;

class TickerJob extends JobBase {

    const SLEEP_TIME = 2;

    const QUEUE = 'ticker';

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

    public function getQueue()
    {
        return self::QUEUE;
    }

    public function generateData()
    {
        $generator = new TickerGenerator(new TickerValues());
        $this->response->pushData(
            $generator->getData()
        );
    }
}