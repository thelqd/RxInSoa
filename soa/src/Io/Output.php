<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 09:44
 */

namespace Soa\Daemon\Io;

use RuntimeException;


class Output {

    /**
     * @var array
     */
    private $data;

    /**
     * @var
     */
    private $output;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     *
     * @throws RuntimeException
     */
    public function render()
    {
        $this->buildJson();
        return $this->output;
    }

    /**
     * @throws RuntimeException
     */
    private function buildJson()
    {
        $this->output = json_encode($this->data);
        if(false === $this->output) {
            throw new RuntimeException('could not build json data');
        }

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}