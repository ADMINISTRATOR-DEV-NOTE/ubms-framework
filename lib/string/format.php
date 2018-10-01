<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class Format {

    // 엔코드
    public function encode($data) {
        return base64_encode($data) . "||";
    }

    public function decode($data) {
        $vars = explode("&", base64_decode(str_replace("||", "", $data)));
        $vars_num = count($vars);
        for ($i = 0; $i < $vars_num; $i++) {
            $elements = explode("=", $vars[$i]);
            $var[$elements[0]] = $elements[1];
        }
        return $var;
    }

    public function cutString($Str, $size, $addStr = "") {
        if (mb_strlen($Str, "utf-8") > $size) {
            return mb_substr($Str, 0, $size, "utf-8");
        } else {
            return $Str;
        }
    }

    // 날자출력 형태
    public function formatDate($string, $check = 1) {
        if ($check == 1) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $string = $year . "/" . $mon . "/" . $day;
        } else if ($check == 2) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $time = substr($string, 11, 2);
            $minu = substr($string, 14, 2);
            $sec = substr($string, 17, 2);
            $string = $year . "/" . $mon . "/" . $day . " " . $time . ":" . $minu . ":" . $sec;
        } else if ($check == 3) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $string = $year . "-" . $mon . "-" . $day;
        } else if ($check == 4) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $time = substr($string, 11, 2);
            $minu = substr($string, 14, 2);
            $string = $year . "-" . $mon . "-" . $day . " " . $time . ":" . $minu;
        } else if ($check == 5) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $string = $year . "년 " . $mon . "월 " . $day . "일";
        } else if ($check == 6) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $time = substr($string, 11, 2);
            $minu = substr($string, 14, 2);
            $string = $year . "년 " . $mon . "월 " . $day . "일 " . $time . "시 " . $minu . "분";
        } else if ($check == 7) {
            $year = substr($string, 0, 4);
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $time = substr($string, 11, 2);
            $minu = substr($string, 14, 2);
            $string = $year . "-" . $mon . "-" . $day;
        } else if ($check == 8) {
            $time = substr($string, 11, 2);
            $minu = substr($string, 14, 2);
            $string = $time . ":" . $minu;
        } else if ($check == 9) {
            $mon = substr($string, 5, 2);
            $day = substr($string, 8, 2);
            $string = $mon . "/" . $day;
        }
        return $string;
    }

    // 숫자로 된 값을 요일로 변환한다. (0:월요일, 1:화요일, 6:일요일)
    public function formatDayOfWeek($check) {
        if ($check == 0) {
            $string = "월요일";
        } else if ($check == 1) {
            $string = "화요일";
        } else if ($check == 2) {
            $string = "수요일";
        } else if ($check == 3) {
            $string = "목요일";
        } else if ($check == 4) {
            $string = "금요일";
        } else if ($check == 5) {
            $string = "토요일";
        } else if ($check == 6) {
            $string = "일요일";
        }
        return $string;
    }

    # 문자열에 한글이 포함되어 있는지 검사하는 함수

    public function isHangeul($string) {
        # 특정 문자가 한글의 범위내(0xA1A1 - 0xFEFE)에 있는지 검사
        $stringCnt = 0;
        while (strlen($string) >= $stringCnt) {
            $char = ord($string[$stringCnt]);
            if ($char >= 0xa1 && $char <= 0xfe) {
                return true;
            }
            $stringCnt++;
        }
    }

    // 파일 확장자 구하는 함수
    public function extensionFile($file) {
        $ex = explode(".", $file);
        $extension = $ex[count($ex) - 1];
        return $extension;
    }

    // 난수 구하기
    public function randomNum($start, $end) {
        srand((double) microtime() * 1000000);
        $tmp = rand($start, $end);
        return $tmp;
    }

    // 그림 파일인지 확인
    public function isImageFile($file) {
        $extension = $this->getExtensionFile($file);
        $array = array("jpg", "jpeg", "gif", "png", "bmp");
        $check = 0;
        for ($i = 0; $i < count($array); $i++) {
            if (!strcasecmp($array[$i], $extension)) {
                //echo"<script  language='JavaScript' charset='utf-8'>alert('$extension');</script>";
                $check++;
            }
        }
        return $check;
    }

    public function isFlashFile($file) {
        $extension = $this->getExtensionFile($file);
        $array = array("swf");
        $check = 0;
        for ($i = 0; $i < count($array); $i++) {
            if (!strcasecmp($array[$i], $extension)) {
                $check++;
            }
        }
        return $check;
    }

    // 문자열 체크(숫자)
    public function isNum($string) {
        if (ereg("^[1-9]+[0-9]*$", $string)) {
            return true;
        } else {
            return false;
        }
    }

    // 문자열 체크(알파)
    public function isAlpha($string) {
        if (ereg("^[a-zA-Z]+[a-zA-Z]*$", $string)) {
            return true;
        } else {
            return false;
        }
    }

    // 문자열 체크(알파+숫자)
    public function isAlphaNum($string) {
        if (ereg("^[1-9a-zA-Z]+[0-9a-zA-Z]*$", $string)) {
            return true;
        } else {
            return false;
        }
    }

    // 문자열 체크(알파+숫자+특수문자)
    public function isAlphaNumAll($string) {
        if (ereg("^[1-9a-zA-Z_-]+[0-9a-zA-Z_-]*$", $string)) {
            return true;
        } else {
            return false;
        }
    }

    //영어랑 숫자가 섞인 난수발생기
    public function randCode($nc, $a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $l = strlen($a) - 1;
        $r = '';
        while ($nc-- > 0)
            $r .= $a{mt_rand(0, $l)};
        return $r;
    }

    public function makeHash($str) {
        $h = sha1($str);
        return $h;
    }

    public function reverse_nl2br($string) {
        return preg_replace("/<br[^>]*>\s*\r*\n*/is", "\n", $string);
    }

}
