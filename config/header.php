<?php

/* 
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CHeader {

    public function __construct() {
        
    }

    public function location($url) {
        header("Location: {$url}");
    }

    public function notFound() {
        header("HTTP/1.0 404 Not Found");
    }

    public function refresh($second) {
        header("Refresh: {$second}");
    }

    public function headerList() {
        return headers_list();
    }

}
