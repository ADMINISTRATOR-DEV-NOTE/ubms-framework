<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CCurl {

    private $target = "";
    private $method = "";
    private $data = [];
    private $timeout = 120;
    private $curl;
    private $error = [];
    private $accessToken;
    private $response;
    private $accept = "application/json";
    private $tokenType = "Bearer";
    private $bearer = " Bearer ";
    private $contentType = "application/json";
    private $tm1;
    private $tm2;
    private $etime;

    public function __construct() {
        if (CConfig::DEBUG) {
            $this->tm1 = array_sum(explode(' ', microtime()));
        }
    }

    public function exec($arrCurl, $accessToken = "") {

        if (strtolower($this->tokenType) == "bearer") {
            $this->bearer = " Bearer ";
        } else if (strtolower($this->tokenType) == "authorization") {
            $this->bearer = "";
        }
        $this->target = $arrCurl['target'];
        $this->method = $arrCurl['method'];
        @$this->data = $arrCurl['data'];
        @$this->timeout = $arrCurl['timeout'];
        $this->accessToken = $accessToken;
        if (!empty($this->accessToken)) {
            $header = array("Authorization:{$this->bearer}{$this->accessToken}", "Accept:{$this->accept}", "Content-Type:{$this->contentType}");
        } else {
            $header = array("Accept:{$this->accept}", "Content-Type:{$this->contentType}");
        }
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->curl, CURLOPT_URL, $this->target);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $this->method);
        if ($this->accept == "application/json") {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($this->data));
        } else {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->data);
        }
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        $this->response = curl_exec($this->curl);
        curl_close($this->curl);
        if (@curl_errno($this->curl)) {
            $this->error['error_num'] = curl_errno($this->curl);
            $this->error['error_msg'] = curl_error($this->curl);
            return $this->error;
        }
        if (CConfig::DEBUG) {
            $this->tm2 = array_sum(explode(' ', microtime()));
            $this->etime = sprintf("%3.3f (sec)", ($this->tm2 - $this->tm1));


            $this->response = array_merge(json_decode($this->response, true), array("time" => $this->etime));

            return json_encode($this->response);
        } else {
            return $this->response;
        }
    }

    public function getTime() {
        return $this->etime;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getError() {
        return $$this->error;
    }

    public function setAccept($accept) {
        $$this->accept = $accept;
    }

    public function getTokenType() {
        return $this->tokenType;
    }

    public function setTokenType($tokenType) {
        $this->tokenType = $tokenType;
    }

    function getContentType() {
        return $this->contentType;
    }

    function setContentType($contentType) {
        $this->contentType = $contentType;
    }

}
