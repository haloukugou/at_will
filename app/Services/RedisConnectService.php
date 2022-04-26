<?php

namespace App\Services;

class RedisConnectService
{
    private static $instance;

    private $redis;

    private function __construct($config)
    {
        $this->redis = new \Redis();
        $this->redis->connect($config['host'], $config['port']);
        $this->redis->auth($config['password']);
        $this->redis->select($config['database']);
    }


    private function __clone()
    {
    }


    public static function getRedisInstance($config)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }


    public function getRedisConn()
    {
        return $this->redis;
    }

}
