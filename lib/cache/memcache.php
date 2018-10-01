<?php

/* 
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class memcache {

    public $conn;
    public $debug;  
    private $host = CConfig::MC_HOST;
    private $port = CConfig::MC_PORT;
    private $connected = false;

    public function __construct() {

        
        if (class_exists('Memcache')) {
            $this->conn = new Memcache();
        } else {
            $this->conn = new Memcached();
        }
    }

    public function __destruct() {
        //$this->conn->close();
    }

    protected function connect() {

        if (class_exists('Memcache')) {

            $this->connected = $this->conn->connect($this->host, $this->port);
        } else {
            $this->connected = $this->conn->addServer($this->host, $this->port);
        }
    }

    public function get($key) {
        if (!$this->connected)
            $this->connect();
        return $this->conn->get($key);
    }

    public function delete($key) {
        return $this->conn->delete($key);
    }

    public function set($key, $value, $expire = 3600) {
        
        if (class_exists('Memcache')) {
            $this->conn->set($key, $value, 0, $expire);
        } else {
            $this->conn->set($key, $value, $expire);
        }
    }

}
