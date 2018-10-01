<?php

/*
 * www.ubermensch.co.kr
 * master@ubermensch.co.kr *
 */

class Test_model extends CDb {

    public $input;
    public $now;
    public $load;
    public $mc;
    public $mqtt;

    public function __construct() {
//        parent::__construct();
        $this->input = CUri::$MAP_REQUEST;
//        $this->now = Date("Y-m-d H:i:s");
        $this->load = new CLoad();
//        $this->mc = $this->load->lib("cache/memcache"); //install memcached
//        $this->mqtt = $this->load->lib("mqtt/mqtt");
    }

    public function _update() {
        $json = '{"message":"0000003","status":true}';
        return $json;
    }

    public function _delete() {
        $json = '{"message":"0000002","status":true}';
        return $json;
    }

    public function _insert() {
        $json = '{"message":"0000001","status":true}';
        return $json;
    }

    public function _select_all() {
        $json .= '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        $json .= '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        $json .= '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        $json .= '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        $json .= '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        return $json;
    }

    public function _select_one() {
        $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        return $json;
    }

}
