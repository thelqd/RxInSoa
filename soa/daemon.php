<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 27.03.15
 * Time: 09:26
 */

require_once __DIR__ . '/vendor/autoload.php';

use Soa\Daemon\Application;
use Soa\Daemon\Http\Request;

$app = new Application(new Request());
$app ->run();

