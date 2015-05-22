<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 11:13
 */

namespace Soa\Daemon\Service;

use Soa\Daemon\Service\Call\ResponseInterface;
use Soa\Daemon\Data\Generator\FullRandom;
use Soa\Daemon\Data\Generator\Ticker as TickerGenerator;
use Soa\Daemon\Data\Values\Ticker as TickerValues;


class Push implements ServiceInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->setData();
    }

    private function setData()
    {
        //$generator = new Generator(new PushValues(), 1, 1);
        $generator = new TickerGenerator(new TickerValues());
        $this->response->pushData(
            $generator->getData()
        );
    }

    public function getData()
    {
        return $this->response->getData();
    }
}