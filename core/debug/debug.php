<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */
include_once '../config/main.php';

class CDebug {

    public $tm1;
    public $tm2;
    public $etime;

    public function __construct() {
        set_error_handler("errorHandler");
    }

    public function start() {
        if (!CConfig::DEBUG) {
            return;
        }
        if (!class_exists('Memcached') && !class_exists('Memcache')) {
            echo"서버에 Memcached를 설치하시오 <br>";
        }
        if (!class_exists('Curl')) {
            echo"서버에 Curl을 설치하시오 <br>";
        }

//        $this->tm1 = array_sum(explode(' ', microtime()));
    }

    public function stop() {
        if (!CConfig::DEBUG) {
            return;
        }

//        $this->tm2 = array_sum(explode(' ', microtime()));
//        $this->etime = sprintf("%3.5f(ms)", ($this->tm2 - $this->tm1));
//        echo"<div style=\"position:relative; width:100px; height:20px; vertical-align:top; text-align:right;color:red;\">$this->etime</div>";
    }

    public function responseInfoJson() {
        if (!CConfig::DEBUG) {
            return;
        }
        return json_encode(array("mode" => "debug", "data" => array("result" => false, "cookie" => $_COOKIE, "session" => $_SESSION, "ARR_URI" => CUri::$ARR_URI, "MAP_REQUEST" => CUri::$MAP_REQUEST)));
    }

    public function exception($str) {
        if (!CConfig::DEBUG) {
            return;
        }
        throw new Exception($str);
    }

    public function log($mix) {
        if (!CConfig::DEBUG) {
            return;
        }
        if (!isset($mix)) {
            echo("변수가 셋팅되지 않았습니다.");
        } else {
            if (empty($mix)) {
                echo("변수값이 NULL 입니다.");
            }
        }
        if (is_array($mix)) {
            echo"<pre>";
            print_r($mix);
            echo"</pre>";
        } else if (is_object($mix)) {
            echo "class : " . get_class($mix);
            echo"<pre>";
            print_r($mix);
            echo"</pre>";
        } else {
            echo($mix);
        }
        return true;
    }

    public function error($msg) {
        if (!CConfig::DEBUG) {
            return;
        }
        trigger_error($msg, E_USER_ERROR);
    }

    public function warning($msg) {
        if (!CConfig::DEBUG) {
            return;
        }
        trigger_error($msg, E_USER_WARNING);
    }

    public function notice($msg) {
        if (!CConfig::DEBUG) {
            return;
        }
        trigger_error($msg, E_USER_NOTICE);
    }

}

function errorHandler($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        //공백
        return false;
    }

    switch ($errno) {
        case E_USER_ERROR:
            echo "<div class='b f_20 red'><b> ERROR</b> <br>error num :[$errno]<br>error msg : $errstr<br />\n";
            echo "PHP " . PHP_VERSION . " (" . PHP_OS . ")<br /></div>\n";
            echo "UBMS_FRAMEWORK <br />\n";


            exit(1);
            break;

        case E_USER_WARNING:
            echo "<div class='b f_20 red'><b> WARNING</b> [$errno] $errstr<br /></div>\n";
            echo " UBMS_FRAMEWORK <br />\n";
            break;

        case E_USER_NOTICE:
            echo "<div class='b f_20 red'><b> NOTICE</b> [$errno] $errstr<br /></div>\n";
            echo " UBMS_FRAMEWORK <br />\n";
            break;

        default:
//            echo "Unknown error type: [$errno] $errstr<br />\n";
            break;
    }
    return true;
}
