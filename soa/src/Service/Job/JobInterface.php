<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 20.05.15
 * Time: 20:55
 */

namespace Soa\Daemon\Service\Job;

use Soa\Daemon\Service\Call\ResponseInterface;

interface JobInterface {

    /**
     * @return int
     */
    public function getSleep();

    /**
     * @param int $seconds
     * @return void
     */
    public function setRuntime($seconds);

    /**
     * @return bool
     */
    public function canStillRun();

    /**
     * @return void
     */
    public function generateData();

    /**
     * @return array
     */
    public function getData();


    /**
     * @return string
     */
    public function getQueue();

    /**
     * @return ResponseInterface
     */
    public function getResponse();
}