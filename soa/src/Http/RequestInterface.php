<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 10:45
 */

namespace Soa\Daemon\Http;


interface RequestInterface {

    /**
     * @param string $mode
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getVar($mode, $key, $value = '');

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getGet($key, $value = '');

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getPost($key, $value = '');
}