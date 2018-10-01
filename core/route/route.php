<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */
include_once '../config/main.php';

class CRoute {

    private $url;
    private $control;
    private $method;
    private $resource;
    private $header;
    private $debug;
    private $httpMethod;

    public function __construct($url) {
        $this->debug = new CDebug();
        if (is_object($url)) {
            if (get_class($url) != "CUrl") {
                $this->debug->exception(get_class($url) . " CUrl 클래스를 넣어주세요. " . __METHOD__);
            }
        } else {
            $this->debug->exception("인자값 " . $url . "은 유효하지않습니다.  CUrl 클래스를 넣어주세요. " . __METHOD__);
        }
        $this->url = $url;
        $this->control = $url->getControl();
        $this->method = $url->getMethod();
        $this->resource = $url->getControl();
        $this->httpMethod = $url->getHttpMethod();
        $this->header = new CHeader();
    }

    public function getUrl() {
        return $this->url;
    }

    public function getControl() {
        return $this->control;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getHttpMethod() {
        return $this->httpMethod;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setControl($control) {
        $this->control = $control;
    }

    public function setMethod($method) {
        $this->method = $method;
    }

    public function setHttpMethod($httpMethod) {
        $this->httpMethod = $httpMethod;
    }

    public function start() {

        if (strtolower(CConfig::ROUTE_TYPE) == "rest") {
            $this->restRoute();
        } else {
            $this->mvcRoute();
        }
    }

    private function existViewClassFile() {
        $arrFile = scandir(CConfig::PATH_VIEW);
        foreach ($arrFile as $file) {
            if (strtolower($file) == strtolower($this->method) . '.php') {
                return true;
            }
        }
        $this->debug->exception("{$this->method}.php 파일이 " . CConfig::PATH_VIEW . "폴더속에 없습니다. <br>method : " . __METHOD__);
        $this->header->location(CConfig::FILE_NOT_FOUND_PATH);
    }

    private function existControlClassFile() {
        $arrFile = scandir(CConfig::PATH_CONTROL);
        foreach ($arrFile as $file) {
            if (strtolower($file) == strtolower($this->control) . '.php') {
                return true;
            }
        }
        $this->debug->exception("{$this->control}.php 파일이  " . CConfig::PATH_CONTROL . "폴더속에 없습니다. <br>method : " . __METHOD__);
        $this->header->location(CConfig::FILE_NOT_FOUND_PATH);
    }

    private function existResourceClassFile() {
        $arrFile = scandir(CConfig::PATH_RESOURCE);
        foreach ($arrFile as $file) {
            if (strtolower($file) == strtolower($this->resource) . '.php') {
                return true;
            }
        }
        $this->debug->exception("{$this->resource}.php 파일이  " . CConfig::PATH_RESOURCE . "폴더속에 없습니다. <br>method : " . __METHOD__);
    }

    private function existMethod($class, $method) {

        $arrMethod = get_class_methods($class);
        foreach ($arrMethod as $item) {
            if ($method == strtolower($item)) {
                return true;
            }
        }
        $this->debug->exception("{$this->control} control class 속에 {$this->method} 메소드가 없습니다.  <br>method : " . __METHOD__);
        $this->header->location(CConfig::FILE_NOT_FOUND_PATH);
    }

    private function mvcRoute() {
        $class = $this->control;
        $controlClass = null;
        $method = $this->method;
        if ($this->existControlClassFile()) {
            include_once (CConfig::PATH_CONTROL . $class . ".php");

            if (class_exists($class)) {
                $controlClass = new $class();
            }

            if ($this->existMethod($controlClass, $method)) {
                $controlClass->$method();
            } else {
                $this->debug->exception("{$this->control} control class 속에 {$this->method} 메소드가 없습니다.  <br>method : " . __METHOD__);
                $this->header->location(CConfig::FILE_NOT_FOUND_PATH);
            }
        }
    }

    private function restRoute() {
        $class = $this->resource;
        $resourceClass = null;
        $strMethod = "";
        if ($this->existResourceClassFile()) {
            include_once (CConfig::PATH_RESOURCE . $class . ".php");
        }
        if (class_exists($class)) {
            $resourceClass = new $class();
        }


        switch ($this->httpMethod) {
            case "get":
                $strMethod = CConfig::PREFIX_GET . "_" . $this->method;
                break;
            case "post":
                $strMethod = CConfig::PREFIX_POST . "_" . $this->method;
                break;
            case "update":
                $strMethod = CConfig::PREFIX_UPDATE . "_" . $this->method;
                break;
            case "delete":
                $strMethod = CConfig::PREFIX_DELETE . "_" . $this->method;
                break;
            case "put":
                $strMethod = CConfig::PREFIX_PUT . "_" . $this->method;
                break;

            default:
                $this->debug->exception("{$this->httpMethod}가 잘못되었습니다. GET,POST,UPDATE,DELETE,PUT 5개만지원합니다.(주의 : curl로 요청보낼경우 대문자표기)  <br>method : " . __METHOD__);
                break;
        }
        if ($this->existMethod($resourceClass, $strMethod)) {

            try {
                $data = $resourceClass->$strMethod();
                $json = [
                    "result" => true,
                    "data" => $data,
                    "input" => file_get_contents("php://input"),
                    "server" => $_SERVER
                ];
                header("Content-type: application/json");
                echo json_encode($json);
            } catch (Exception $e) {
                $json = [
                    "result" => false,
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "input" => file_get_contents("php://input"),
                    "server" => $_SERVER
                ];
                header("Content-type: application/json");
                echo json_encode($json);
            }
        } else {
            $json = [
                "result" => false,
                "message" => "rest 서버의 리소스관리 주소가 변경되었거나, 요청이 잘못되었습니다. ",
                "input" => file_get_contents("php://input")
            ];
            header("Content-type: application/json");
            echo json_encode($json);
        }
    }

}
