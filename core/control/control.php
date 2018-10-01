<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CControl {

    public $debug;
    public $load;
    public $header;
    public $curl;
    public $request = [];

    public function __construct() {
        ob_start();
        $this->debug = new CDebug();
        $this->debug->start();
        $this->load = new CLoad();
        $this->header = new CHeader();
        $this->curl = new CCurl();

        foreach (CUri::$MAP_REQUEST as $key => $value) {
            $this->request[$key] = strip_tags(urldecode($value));
        }
    }

    public function __destruct() {
        $this->debug->stop();
        ob_end_flush();
    }

}
