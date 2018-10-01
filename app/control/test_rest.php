<?php

/*
 * www.ubermensch.co.kr
 * master@ubermensch.co.kr * 
 */

// if config.php in config folder, set --> const ROUTE_TYPE = "rest";
class Test_rest extends CControl {

    private $test_model;

    public function __construct() {
        parent::__construct();
        // must exist 'Test_model' in model folder  , you should make 'Test_model' class
        $this->test_model = $this->load->model("test_model"); //load model class
    }

    public function get_index() {//request method : GET , invoke url : www.ubms.kr/test_rest 
        return $this->test_model->_select_all();
    }

    public function post_index() {//request method : POST , invoke url : www.ubms.kr/test_rest 
        return $this->test_model->_insert();
    }

    public function put_index() {//request method : PUT , invoke url : www.ubms.kr/test_rest 
        return $this->test_model->_upload();
    }

    public function delete_index() {//request method : DELETE , invoke url : www.ubms.kr/test_rest 
        return $this->test_model->_delete();
    }

    public function get_read() {//request method : GET , invoke url : www.ubms.kr/test_rest/read 
        return $this->test_model->_select_one();
    }

}
