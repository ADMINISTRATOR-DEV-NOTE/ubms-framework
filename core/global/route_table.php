<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CRouteTable {
    // only php 7.0 enable !!!
    static private $ROUTE_TABLE_REST = [];
    static private $ROUTE_TABLE_MVC = [];

    //auto redirection
    //rest 
    static public function getRouteTableREST() {
        //:num :ani 가능
//        CRouteTable::$ROUTE_TABLE_REST['index/courseinfo'] = 'courseinfo';  // index/courseinfo <-- courseinfo
//        CRouteTable::$ROUTE_TABLE_REST['hit/index/:num'] = 'hit/:num';      // hit/index/12345 <-- hit/12345
//        CRouteTable::$ROUTE_TABLE_REST['board/index/:ani'] = 'board/:ani';  // board/index/string-number <-- board/string-number
        return CRouteTable::$ROUTE_TABLE_REST;
    }

    //mvc 
    static public function getRouteTableMVC() {
        //:num :ani 가능
//        CRouteTable::$ROUTE_TABLE_MVC['index/index'] = '';
//        CRouteTable::$ROUTE_TABLE_MVC['index/courseinfo'] = 'courseinfo';  // index/courseinfo <-- courseinfo
//        CRouteTable::$ROUTE_TABLE_MVC['hit/index/:num'] = 'hit/:num';      // hit/index/12345 <-- hit/12345
//        CRouteTable::$ROUTE_TABLE_MVC['board/index/:ani'] = 'board/:ani';  // board/index/string-number <-- board/string-number
        return CRouteTable::$ROUTE_TABLE_MVC;
    }

}
