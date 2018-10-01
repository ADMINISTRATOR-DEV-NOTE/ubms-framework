<?php

/* www.ubermensch.co.kr
 * master@ubermensch.co.kr 
 */

class Filters extends CControl {

    public function __construct() {
        parent::__construct(); // must put first
    }

    public function __destruct() {
        parent::__destruct(); // must put first
    }

    public function check_email() {
        $tmp = filter_var($this->request["email"], FILTER_VALIDATE_EMAIL);
        if ($tmp == true) {
            echo json_encode(array("RESULT" => true));
        } else {
            echo json_encode(array("RESULT" => false));
        }
    }

    public function check_ip() {
        $tmp = filter_var($this->request["ip"], FILTER_VALIDATE_IP);
        if ($tmp == true) {
            echo json_encode(array("RESULT" => true));
        } else {
            echo json_encode(array("RESULT" => false));
        }
    }

    public function check_mac() {
        $tmp = filter_var($this->request["mac"], FILTER_VALIDATE_MAC);
        if ($tmp == true) {
            echo json_encode(array("RESULT" => true));
        } else {
            echo json_encode(array("RESULT" => false));
        }
    }

    public function check_int() {
        $tmp = filter_var($this->request["int"], FILTER_VALIDATE_INT);
        if ($tmp == true) {
            echo json_encode(array("RESULT" => true));
        } else {
            echo json_encode(array("RESULT" => false));
        }
    }

    public function check_domein() {
        $tmp = filter_var($this->request["domein"], FILTER_VALIDATE_DOMAIN);
        if ($tmp == true) {
            echo json_encode(array("RESULT" => true));
        } else {
            echo json_encode(array("RESULT" => false));
        }
    }

    public function check_passwd() {

        $pw;
        if (!empty($this->request["password"])) {
            $pw = $this->request["password"];
        } else {
            $pw = $this->request["passwd"];
        }

        if (!preg_match('/^.*(?=^.{8,20}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*-_]).*$/', $pw)) {
            echo json_encode(array("RESULT" => false));
        } else {
            echo json_encode(array("RESULT" => true));
        }
    }

    public function email($email) {
        $tmp = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($tmp == true) {
            return true;
        } else {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "email 이 유효하지않습니다."));
            return false;
        }
    }

    public function ip($ip) {
        $tmp = filter_var($ip, FILTER_VALIDATE_IP);
        if ($tmp == true) {
            return true;
        } else {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "ip 가 유효하지않습니다."));
            return false;
        }
    }

    public function mac($mac) {
        $tmp = filter_var($mac, FILTER_VALIDATE_MAC);
        if ($tmp == true) {
            return true;
        } else {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "mac 이 유효하지않습니다."));
            return false;
        }
    }

    public function integer($integer) {
        $tmp = filter_var($integer, FILTER_VALIDATE_INT);
        if ($tmp == true) {
            return true;
        } else {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "integer 가 유효하지않습니다."));
            return false;
        }
    }

    public function domein($domein) {
        $tmp = filter_var($domein, FILTER_VALIDATE_DOMAIN);
        if ($tmp == true) {
            return true;
        } else {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "domein 이 유효하지않습니다."));
            return false;
        }
    }

    public function passwd($pw) {
        if (!preg_match('/^.*(?=^.{8,20}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*-_]).*$/', $pw)) {
            echo json_encode(array("RESULT" => false, "MESSAGE" => "password 가 유효하지않습니다."));
            return false;
        } else {
            return true;
        }
    }

}
