<?php
/* 
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

include_once '../lib/filter/rule.php';

class Filter {

    private $filter;

    public function __construct() {
        global $filterConfig;
        $this->filter = new HTMLPurifier($filterConfig);
    }

    public function exec($html) {
        $htmlTmp = $this->filter->purify(urldecode($html));
        return $htmlTmp;
    }

}
