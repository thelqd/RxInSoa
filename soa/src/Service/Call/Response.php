<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 11:51
 */

namespace Soa\Daemon\Service\Call;


class Response implements ResponseInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $data = array();

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param array $data
     */
    public function pushData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->buildResponse();
    }

    /**
     * @return array
     */
    private function buildResponse()
    {
        $response = array();
        $response['type'] = $this->type;
        $response['data'] = $this->data;
        return $response;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return void
     */
    public function clearData()
    {
        $this->data = array();
    }


}