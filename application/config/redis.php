<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * redis driver for netgra
 * @author don
 * @version 0.0.1
 */

$config = array(
    'default' => array(
        'socket_type' => 'tcp',
        'socket' => '/var/run/redis.sock',
        'host' => '127.0.0.1',
        'password' => null,       
        'port'     => 6379,
        'timeout'  => 0,
    ),
);