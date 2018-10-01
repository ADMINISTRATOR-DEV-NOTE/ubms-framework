<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

include_once '../config/main.php';
include_once 'global/main.php';
include_once 'debug/main.php';
include_once 'db/main.php';
include_once 'load/main.php';
include_once 'control/main.php';
include_once 'route/main.php';
include_once '../core/db/db.php';
try {
    $url = new CUrl();
    $url->setHttpMethod($_SERVER['REQUEST_METHOD']);
//    $url->setHttpMethod("get");
//    $url->setHttpMethod("post");
//    $url->setHttpMethod("put");
//    $url->setHttpMethod("update");
//    $url->setHttpMethod("delete");
    $route = new CRoute($url);
    $route->start();
} catch (Exception $e) {

    if ($url->isRouting) {
        $routeTable = "주 의 : 사용자가 작성한 라우팅테이블 규칙에 의해 라우팅 되었습니다.<br>{$url->applyRouteTable}";
    } else {
        $routeTable = "";
    }
    echo "<div style='font-size:15px; border:5px solid black; width:900px;background-color:gray; margin:auto;'>"
    . "<font color='blue'>개발중에만 키고 서비스중에는 반드시 끌 것<br>"
    . "예외발생 끄기 경로 /config/config.php 속의 상수 DEBUG = false; 할 것</font><br><br><br>"
    . "<h1>ROUTE TYPE : <font color='silver'>" . CConfig::ROUTE_TYPE . "</font> </h1>"
    . "<h1><font color='silver'>" . $routeTable . "</font> </h1>"
    . "<h1>예외발생 : " . $e->getMessage() . "</h1>";
    echo "<pre>";
    echo "<div style='color:black; background-color:silver;'>request 정보<br>";
    print_r($_REQUEST);
    echo "</div><br>";
    echo "<div style='color:black; width:900px; background-color:silver;'>행위추적<br>";
    print_r($e->getTrace());
    echo "</div><br>";
    echo "<div style='color:black; width:900px;background-color:silver;'>FILE 정보<br>";
    echo"<br>file : " . $url->getFilename();
    echo"<br>extention : " . $url->getExtension();
    echo"<br>basename : " . $url->getBasename();
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'>URL 정보<br>";
    print_r($url->getInfo());
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'> URI MAP 정보 -- 앞에서 2개(control.method) 빼고나머지 <br>";
    print_r($url->getMapUri());
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'> ALL URI MAP 정보 <br>";
    print_r($url->getMapAll());
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'> URI ARR 정보 -- 앞에서 2개(control.method) 빼고나머지 <br>";
    print_r($url->getArrUri());
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'> ALL URI ARR 정보 <br>";
    print_r($url->getArrAll());
    echo "</div><br>";
    echo "<div style = 'color:black; width:900px;background-color:silver;'> request headers <br>";
    print_r($url->getHeaders());
    echo "</div><br>";
    echo "</pre>";
    echo "</div>";
}


