<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */
include_once "../lib/crypto/aes.php";

class PageToken {

    public function makeToken($sessionName) {
        $_SESSION[$sessionName] = $this->randCode(6) . time();
        $strTmp = $_SESSION[$sessionName] . "@@@" . $_SERVER['REMOTE_ADDR'];
        $crypto = sha1($this->encrypt($strTmp));
        setcookie($sessionName, $crypto, 0, "/");
    }

    public function compareToken($sessionName) {
        $strTmp = $_SESSION[$sessionName] . "@@@" . $_SERVER['REMOTE_ADDR'];
        $crypto = sha1($this->encrypt($strTmp));
        if ($_COOKIE[$sessionName] == $crypto) {
            unset($_COOKIE[$sessionName]);
            setcookie($sessionName, null, -1, '/');
            $_SESSION[$sessionName] = "";
            return true;
        } else {
            unset($_COOKIE[$sessionName]);
            setcookie($sessionName, null, -1, '/');
            $_SESSION[$sessionName] = "";
            return false;
        }
    }

    public function encrypt($str) {
        $a = new Aes(CConfig::AES_PASSWORD);
        $e = base64_encode($a->encrypt($str));
        return $e;
    }

    public function decrypt($str) {
        $a = new Aes(CConfig::AES_PASSWORD);
        $d = $a->decrypt(base64_decode($str));
        return $d;
    }

    public function randomNum($start, $end) {
        srand((double) microtime() * 1000000);
        $tmp = rand($start, $end);
        return $tmp;
    }

    public function randCode($nc, $a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $l = strlen($a) - 1;
        $r = '';
        while ($nc-- > 0)
            $r .= $a{mt_rand(0, $l)};
        return $r;
    }

}
