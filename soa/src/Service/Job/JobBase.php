<?php

namespace Soa\Daemon\Service\Job;

use Soa\Daemon\Service\Call\Response;

abstract class JobBase implements JobInterface {

    /**
     * @var int
     */
    private $shutdownTime;

    /**
     * @var Response
     */
    protected $response;

    public function __construct($runtime)
    {
        $this->setRuntime($runtime);
        $this->response = new Response(Response::TYPE_PUSH);
    }

    /**
     * @param int $runtime
     */
    public function setRuntime($runtime)
    {
        if($runtime > 0) {
            $this->shutdownTime = time() + $runtime;
        } else {
            $this->shutdownTime = 0;
        }
    }

    /**
     * @return bool
     */
    public function canStillRun()
    {
        if($this->shutdownTime > 0) {
            return time() < $this->shutdownTime;
        } else {
            return true;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->response->getData();
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}