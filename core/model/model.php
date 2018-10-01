<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CModel {

    public $debug;
    public $db;

    public function __construct() {
        $this->debug = new CDebug();
        $this->debug->start();
        $this->db = new CDb();
    }

    public function __destruct() {
        $this->debug->stop();
    }

}
