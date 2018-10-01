<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */
include_once '../config/main.php';

class CUrl {

    private $ip = "";
    private $user = "";
    private $pass = "";
    private $fragment = "";
    private $scheme = "";
    private $httpMethod = "";
    private $host = "";
    private $port = "";
    private $url = "";
    private $uri = "";
    private $filename = "";
    private $extension = "";
    private $basename = "";
    private $path = "";
    private $query = "";
    private $control = "";
    private $method = "";
    private $resource = "";
    private $token = "";
    private $mapUri = [];
    private $arrUri = [];
    private $mapAll = [];
    private $arrAll = [];
    private $mapQuery = [];
    private $info = [];
    private $mapRequest = [];
    public $isRouting = false;
    public $applyRouteTable = "";
    public $agent;
    private $headers = [];

    public function __construct($url = "") {

        if (empty($url)) {
            $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            $_SESSION['agent'] = "mobile";
            $this->agent = "mobile";
        } else {
            $_SESSION['agent'] = "pc";
            $this->agent = "pc";
        }

        $urlTmp = filter_var($url, FILTER_SANITIZE_URL);
        $this->token = $this->getBearerToken();
        $this->mapRequest = json_decode(file_get_contents('php://input'), true, 512, JSON_BIGINT_AS_STRING);
        $arrParseTmp = parse_url($urlTmp);
        $arrParse = [];
        foreach ($arrParseTmp as $key => $value) {
            if ($key != "path") {
                $arrParse[$key] = strtolower($value);
            } else {
                $arrParse[$key] = $value;
            }
        }
        $this->info = $arrParse;
        $this->user = $arrParse['user'];
        $this->pass = $arrParse['pass'];
        $this->fragment = $arrParse['fragment'];
        $this->scheme = $arrParse['scheme'];
        $this->host = $arrParse['host'];
        $this->port = $arrParse['port'];
        $this->url = $url;
        $this->uri = $arrParse['path'];
        $this->path = $arrParse['path'];
        $this->query = $arrParse['query'];

        $path_parts = pathinfo($url);
        $this->filename = $path_parts['basename'];
        $this->extension = $path_parts['extension'];
        $this->basename = $path_parts['filename'];

        $this->makeUri($arrParse);
        $request = [];

        foreach ($_REQUEST as $key => $value) {
            $arrTmp = explode("?", $key);
            if (!empty($arrTmp[1])) {
                $request[$arrTmp[1]] = $value;
            } else {
                $request = [];
            }
        }
        $_REQUEST = $request;
        return $this;
    }

    private function makeUri($arrParse) {
        $strTmp = str_replace(CConfig::FILTER_STRING_URI, "", strip_tags(urldecode($arrParse['path'])));
        $arrTmp = explode("/", $strTmp);
        $a = 0;
        $arrDest = [];
        foreach ($arrTmp as $value) {
            if ($a > 2) {
                array_push($arrDest, $value);
            } else {
                array_push($arrDest, strtolower($value));
            }
            $a++;
        }
        $this->arrUri = array_slice($arrDest, 1);

        $this->routeTable();
//        $this->routeAddIndex();   //자동라우팅 해깔리니 안쓰면뺄 계획임

        $i = 0;
        $key = "";
        $item_key = "";
        foreach ($this->arrUri as $item) {



            switch ($i) {
                case 0:
                    $key = "control";
                    if (empty($item)) {
                        $this->control = CConfig::DEFAULT_CONTORL;
                        $this->method = CConfig::DEFAULT_METHOD;
                    } else {
                        $this->control = $item;
                    }
                    array_push($this->mapAll, [$key => $this->control]);
                    array_push($this->arrAll, $this->control);
                    break;
                case 1:
                    $key = "method";
                    if (empty($item)) {
                        $this->method = CConfig::DEFAULT_METHOD;
                    } else {
                        $this->method = $item;
                    }
                    array_push($this->mapAll, [$key => $this->method]);
                    array_push($this->arrAll, $this->method);
                    break;
                default :
                    if ($i % 2 == 0) {
                        $item_key = $item;
                        array_push($this->mapUri, [$item_key => ""]);
                    } else {
                        $size = sizeof($this->mapUri) - 1;
                        $this->mapUri[$size][$item_key] = $item;
                        $item_key = "";
                    }
                    $ii = $i - 0;

                    if ($ii % 2 == 0) {
                        $key = "key";
                    } else {
                        $key = "value";
                    }
                    array_push($this->mapAll, [$key => $item]);
                    array_push($this->arrAll, $item);
                    break;
            }
            $i++;
        }

        $this->arrUri = array_slice($this->arrUri, 2);
        CUri::$MAP_URI = $this->mapUri;
        CUri::$ARR_URI = $this->arrUri;
        CUri::$MAP_ALL = $this->mapAll;
        CUri::$ARR_ALL = $this->arrAll;
        CUri::$HTTP_METHOD = $this->httpMethod;
        CUri::$TOKEN = $this->token;
        parse_str($this->query, $this->mapQuery);
        CUri::$MAP_QUERY = $this->mapQuery;


        if (empty($this->mapRequest)) {
            CUri::$MAP_REQUEST = array_slice($_REQUEST, 1);
        } else {
            CUri::$MAP_REQUEST = $this->mapRequest;
        }
    }

    private function routeTable() {
        $mapRouteTable = [];
        if (CConfig::ROUTE_TYPE == "mvc") {
            $mapRouteTable = CRouteTable::getRouteTableMVC();
        } else {
            $mapRouteTable = CRouteTable::getRouteTableREST();
        }

        foreach ($mapRouteTable as $dest => $route) {
            $arrDest = explode("/", $dest);
            $arrRoute = explode("/", $route);
            $arrUriTmp = [];
            $arrDestTmp = [];
            $i = 0;
            foreach ($arrRoute as $value) {
                if ($value == ":num") {
                    if (is_numeric($this->arrUri[$i])) {
                        array_push($arrUriTmp, ":num");
                        $arrDestTmp = [];
                        foreach ($arrDest as $destItem) {
                            if ($destItem == ":num") {
                                array_push($arrDestTmp, $this->arrUri[$i]);
                            } else {
                                array_push($arrDestTmp, $destItem);
                            }
                        }
                    }
                } else if ($value == ":any") {
                    if (!empty($this->arrUri[$i])) {
                        array_push($arrUriTmp, ":any");
                        $arrDestTmp = [];
                        foreach ($arrDest as $destItem) {
                            if ($destItem == ":any") {
                                array_push($arrDestTmp, $this->arrUri[$i]);
                            } else {
                                array_push($arrDestTmp, $destItem);
                            }
                        }
                    }
                } else {
                    array_push($arrUriTmp, $this->arrUri[$i]);
                    $arrDestTmp = $arrDest;
                }
                $i++;
            }
            if ($arrRoute == $arrUriTmp) {
                $this->arrUri = array_slice($this->arrUri, sizeof($arrRoute));
                $this->arrUri = array_merge($arrDestTmp, $this->arrUri);
                $this->isRouting = true;
                $this->applyRouteTable = "{$route} ===> {$dest} ";
                return;
            }
        }
        $this->isRouting = false;
    }

    private function routeAddIndex() {
        $arrTmp = [];
        $i = 0;
        if (is_numeric($this->arrUri[1])) {
            foreach ($this->arrUri as $uri) {
                if ($i == 1) {
                    array_push($arrTmp, CConfig::DEFAULT_METHOD);
                    array_push($arrTmp, $uri);
                } else {
                    array_push($arrTmp, $uri);
                }
                $i++;
            }
            $this->arrUri = $arrTmp;
        }
    }

    private function getAuthorizationHeader() {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        $this->headers = $this->getHeaders();
        return $headers;
    }

    public function getHeaders() {
        if (!function_exists('apache_request_headers')) {
            $arh = array();
            $rx_http = '/\AHTTP_/';
            foreach ($_SERVER as $key => $val) {
                if (preg_match($rx_http, $key)) {
                    $arh_key = preg_replace($rx_http, '', $key);
                    $rx_matches = array();
                    $rx_matches = explode('_', $arh_key);
                    if (count($rx_matches) > 0 and strlen($arh_key) > 2) {
                        foreach ($rx_matches as $ak_key => $ak_val)
                            $rx_matches[$ak_key] = ucfirst($ak_val);
                        $arh_key = implode('-', $rx_matches);
                    }
                    $arh[$arh_key] = $val;
                }
            }
            return( $arh );
        } else {
            return apache_request_headers();
        }
    }

    private function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getFragment() {
        return $this->fragment;
    }

    public function getScheme() {
        return $this->scheme;
    }

    public function getHttpMethod() {
        return $this->httpMethod;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getUri() {
        return $this->uri;
    }

    public function getPath() {
        return $this->path;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getControl() {
        return $this->control;
    }

    public function getMethod() {
        if (empty($this->method)) {
            $this->method = CConfig::DEFAULT_METHOD;
        }
        return $this->method;
    }

    public function getResource() {
        return $this->resource;
    }

    public function getMapUri() {
        return $this->mapUri;
    }

    public function getArrUri() {
        return $this->arrUri;
    }

    public function getMapAll() {
        return $this->mapAll;
    }

    public function getArrAll() {
        return $this->arrAll;
    }

    public function getMapUriREST() {
        return $this->mapUriREST;
    }

    public function getArrUriREST() {
        return $this->arrUriREST;
    }

    public function getMapAllREST() {
        return $this->mapAllREST;
    }

    public function getArrAllREST() {
        return $this->arrAllREST;
    }

    public function setMapUriREST($map) {
        $this->mapUriREST = $map;
    }

    public function setArrUriREST($arr) {
        $this->arrUriREST = $arr;
    }

    public function setMapAllREST($map) {
        $this->mapAllREST = $map;
    }

    public function setArrAllREST($arr) {
        $this->arrAllREST = $arr;
    }

    public function getInfo() {
        return $this->info;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function setFragment($fragment) {
        $this->fragment = $fragment;
    }

    public function setScheme($scheme) {
        $this->scheme = $scheme;
    }

    public function setHttpMethod($httpMethod) {
        $this->httpMethod = strtolower($httpMethod);
        $this->info['httpMethod'] = strtolower($httpMethod);
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setUri($uri) {
        $this->uri = $uri;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setControl($control) {
        $this->control = $control;
    }

    public function setMethod($method) {
        $this->method = $method;
    }

    public function setResource($resource) {
        $this->resource = $resource;
    }

    public function setMapUri($map) {
        $this->mapUri = $map;
    }

    public function setArrUri($arr) {
        $this->arrUri = $arr;
    }

    public function setMapAll($map) {
        $this->mapAll = $map;
    }

    public function setArrAll($arr) {
        $this->arrAll = $arr;
    }

    public function setInfo($info) {
        $this->info = $info;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getBasename() {
        return $this->basename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function setBasename($basename) {
        $this->basename = $basename;
    }

}
