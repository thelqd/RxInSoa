<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 20.05.15
 * Time: 21:07
 */

namespace Soa\Daemon\Http;


class Cli implements RequestInterface {

    private $arguments = array();

    public function __construct()
    {
        $this->setCliArgs();
    }

    private function setCliArgs()
    {
        global $argc, $argv;
        if ($argc < 2) {
            throw new \InvalidArgumentException('No Job declared');
        }

        $this->arguments['job'] = $argv[1];
        if (isset($argv[2])) {
            $this->arguments['runtime'] = (int)$argv[2];
        } else {
            $this->arguments['runtime'] = -1;
        }
    }

    public function getVar($mode, $key, $default = '') {
        if(isset($this->arguments[$key])) {
            return $this->arguments[$key];
        } else {
            return $default;
        }
    }

    public function getGet($key, $default = '')
    {
        return $this->getVar('', $key, $default);
    }

    public function getPost($key, $default = '')
    {
        return $this->getVar('', $key, $default);
    }
}