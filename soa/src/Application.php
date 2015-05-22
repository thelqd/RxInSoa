<?php

namespace Soa\Daemon;

use Soa\Daemon\Http\RequestInterface;
use Soa\Daemon\Http\Cli;
use Soa\Daemon\Service\JobLauncher;
use Soa\Daemon\Service\JobFactory;
use Soa\Daemon\Service\Call\Response;
use Soa\Daemon\Io\Output;

class Application {

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function run()
    {
        if($this->isCommandLineInterface()) {
            try {
                $this->request = new Cli();
            } catch(\InvalidArgumentException $e) {
                print $e->getMessage();
            }
            $this->startCliJob();
        } else {
            $jobName = $this->request->getGet('job', null);
            if(isset($jobName)) {
                $this->startWebJob($jobName);
            } else {
                print 'no job given';
            }
        }

    }

    /**
     * @return bool
     */
    private function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }

    /**
     * @return void
     */
    private function startCliJob()
    {
        try {
            $jobLauncher = new JobLauncher(
                $this->request->getGet('job'),
                $this->request->getGet('runtime')
            );
            $jobLauncher->run();
        } catch(\RuntimeException $e) {
            print $e->getMessage();
        }
    }

    /**
     * @param $jobName
     * @return void
     */
    private function startWebJob($jobName)
    {
        try {
            $job = JobFactory::load($jobName);
            $job->generateData();
            $response = $job->getResponse();
            $response->setType(Response::TYPE_GET);
            $output = new Output($response->getData());
            print $output;
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

}