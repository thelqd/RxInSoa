<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 11:52
 */

namespace Soa\Daemon\Service\Call;


interface ResponseInterface
{
    /**
     * @var int
     */
    const TYPE_PUSH = 0;

    /**
     * @var int
     */
    const TYPE_GET = 1;

    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     * @return void
     */
    public function pushData(array $data);

    /**
     * @param int $type
     * @return void
     */
    public function setType($type);
}