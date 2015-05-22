<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 20.05.15
 * Time: 21:27
 */

namespace Soa\Daemon\Service;

use Soa\Daemon\Service\Job\JobInterface;
use Soa\Daemon\Io\Output;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class JobLauncher {

    /**
     * @var string
     */
    private $jobName;

    /**
     * @var int
     */
    private $runtime;

    /**
     * @var JobInterface
     */
    private $job;

    /**
     * @param string $job
     * @param int $runtime
     */
    public function __construct($job, $runtime = -1) {
        $this->jobName = $job;
        $this->runtime = $runtime;
    }

    /**
     * Loads and executes actual job
     */
    public function run()
    {
        $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $this->job = JobFactory::load($this->jobName, $this->runtime);

        while($this->job->canStillRun()) {
            $jobResult = $this->executeJob();
            // the job itself controls a sleep
            $msg = new AMQPMessage($jobResult);
            $channel->basic_publish($msg, '', $this->job->getQueue());
            if($this->job->getSleep() > 0) {
                sleep($this->job->getSleep());
            }
        }
        $channel->close();
        $connection->close();
    }

    /**
     * @return string
     */
    private function executeJob()
    {
        $this->job->generateData();
        $output = new Output($this->job->getData());
        return (string)$output;
    }
}