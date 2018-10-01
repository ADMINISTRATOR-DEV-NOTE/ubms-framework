<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */
include_once '../config/main.php';

class CLoad {

    private $debug;
    private $dir;
    private $file;

    public function __construct() {
        $this->debug = new CDebug();
    }

    public function model($path) {
        $this->setDir($path);
        $file = "";
        $arrFile = scandir(CConfig::PATH_MODEL . $this->dir);
        foreach ($arrFile as $item) {
            if (strtolower($item) == strtolower($this->file) . '.php') {
                $file = $item;
                include_once CConfig::PATH_MODEL . $this->dir . $file;
                $obj = new $this->file();
                return $obj;
            }
        }
        $this->debug->exception("{$this->file}.php  파일이 " . CConfig::PATH_MODEL . $this->dir . "폴더속에 없습니다. <br>method : " . __METHOD__);
    }

    public function view($path, $data = "") {
        $this->setDir($path);
        $file = "";
        $arrFile = scandir(CConfig::PATH_VIEW . $this->dir);
        foreach ($arrFile as $item) {
            if (strtolower($item) == strtolower($this->file) . '.php') {
                $file = $item;
                if (!empty($data)) {
                    $_REQUEST = $data;
                    extract($_REQUEST);
                }
                include CConfig::PATH_VIEW . $this->dir . $file;
                return;
            }
        }
        $this->debug->exception("{$this->file}.php  파일이 " . CConfig::PATH_VIEW . $this->dir . "폴더속에 없습니다. <br>method : " . __METHOD__);
    }

    public function control($path) {
        $this->setDir($path);
        $file = "";
        $arrFile = scandir(CConfig::PATH_CONTROL . $this->dir);
        foreach ($arrFile as $item) {
            if (strtolower($item) == strtolower($this->file) . '.php') {
                $file = $item;
                include CConfig::PATH_CONTROL . $this->dir . $file;
                $obj = new $this->file();
                return $obj;
            }
        }
        $this->debug->exception("{$this->file}.php  파일이 " . CConfig::PATH_CONTROL . $this->dir . "폴더속에 없습니다. <br>method : " . __METHOD__);
    }

    public function lib($path) {
        $obj;
        $this->setDir($path);
        $file = "";
        $fileTmp = $this->file;
        $arrFile = scandir(CConfig::PATH_LIB . $this->dir);
        foreach ($arrFile as $item) {
            if (strtolower($item) == strtolower($fileTmp) . '.php') {
                $file = $item;
                include CConfig::PATH_LIB . $this->dir . $file;
                $obj = new $fileTmp();
                return $obj;
            }
        }
        $this->debug->exception("{$fileTmp}.php  파일이 " . CConfig::PATH_LIB . $this->dir . "폴더속에 없습니다. <br>method : " . __METHOD__);
    }

    public function clear() {
        foreach ($_REQUEST as $key => $val) {
            $_REQUEST[$key] = "";
        }
    }

    private function setDir($str) {
        $this->dir = "";
        $arr = explode("/", $str);
        $length = sizeof($arr) - 1;
        $this->file = $arr[$length];
        $i = 0;
        foreach ($arr as $item) {
            if ($i < $length) {
                $this->dir .= $item . "/";
            }
            $i++;
        }
    }

}
