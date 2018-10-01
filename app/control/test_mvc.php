<?php

/* www.ubermensch.co.kr
 * master@ubermensch.co.kr 
 */

// if config.php in config folder, set --> const ROUTE_TYPE = "mvc";
class Test_mvc extends CControl {

    private $token;

    public function __construct() {
        parent::__construct(); // must put first
        $this->token = $this->load->lib("token/pageToken"); //must make page-token  in this case below  " write form submit data at client -->  write_ok accept data on server side " 
        $filter = $this->load->lib("filter/filter"); // eg : xss filtering for "content"
        if ($key == "content") {
            $this->request[$key] = $filter->exec($value);
        } else {
            $this->request[$key] = strip_tags(urldecode($value));
        }
        // load  parts in  early time
        $this->load->view("top");
        $this->load->view("head");
    }

    public function __destruct() {
        parent::__destruct(); // must put first
        // load  parts at the last
        $this->load->view("foot");
    }

    public function index() {
        //if no method-name, invoke default --> www.ubms.kr/test_mvc
        $this->load->view("main");
    }

    public function write() {
        //if method-name 'write' exists, invoke write method --> www.ubms.kr/test_mvc/write
        $this->token->makeToken("BOARD_WRITE_OK"); // set page-token key with literal strings like "BOARD_WRITE_OK" in write time put on server session
        $this->load->view("board");
    }

}
