<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 20.05.15
 * Time: 21:45
 */

namespace Soa\Daemon\Service;

use Soa\Daemon\Service\Job\AutoCompleteJob;
use Soa\Daemon\Service\Job\JobInterface;
use Soa\Daemon\Service\Job\PrivateMessageJob;
use Soa\Daemon\Service\Job\TickerJob;

class JobFactory {

    /**
     * @var array
     */
    private static $availableJobs = array(
        'ticker',
        'pm',
        'autocomplete'
    );

    /**
     * @param $jobName
     * @param $runtime
     * @return JobInterface
     */
    public static function load($jobName, $runtime = -1) {
        if(!in_array($jobName, self::$availableJobs)) {
            throw new \RuntimeException('unknown job');
        }

        $loadedObject = null;

        switch($jobName) {
            case 'ticker':
                $loadedObject = new TickerJob($runtime);
                break;
            case 'pm':
                $loadedObject = new PrivateMessageJob($runtime);
                break;
            case 'autocomplete':
                $loadedObject = new AutoCompleteJob($runtime);
                break;
        }

        return $loadedObject;
    }
}