<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 10:22
 */

namespace Soa\Daemon\Http;

use InvalidArgumentException;

class Request implements RequestInterface {

    /**
     * @var array
     */
    private $data = array(
        'get' => array(),
        'post' => array()
    );


    /**
     *
     */
    public function __construct()
    {
        $this->setUp();
    }

    /**
     * @param array $global
     * @return array
     */
    private function processArray(array $global)
    {
        $returnArr = array();
        foreach($global as $key => $value) {
            //do sanitizing if needed
            $returnArr[$key] = $value;
        }
        return $returnArr;
    }

    /**
     *
     */
    private function setUp()
    {
        $this->data['get'] = $this->processArray($_GET);
        $this->data['post'] = $this->processArray($_POST);
    }

    /**
     * @param string $mode
     * @param string $key
     * @param string $default
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getVar($mode, $key, $default = '')
    {
        if(!array_key_exists($mode, $this->data)) {
            throw new InvalidArgumentException('unkown mode');
        }

        if(isset($this->data[$mode][$key])) {
            return $this->data[$mode][$key];
        } else {
            return $default;
        }
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getGet($key, $default = '')
    {
        return $this->getVar('get', $key, $default);
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getPost($key, $default = '')
    {
        return $this->getVar('post', $key, $default);
    }


}