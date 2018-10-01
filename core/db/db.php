<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CDb {

    public $db;
    public $result;
    public $format = "json";
    private $debug;
    private $user = CConfig::DB_USER;
    private $password = CConfig::DB_PASSWD;
    private $database = CConfig::DB_SCHEMA;
    private $host = CConfig::DB_HOST;
    private $port = CConfig::DB_PORT;
    private $insert_id = 0;

    public function __construct() {
        $this->debug = new CDebug();
        $this->db = $this->connect();
        if ($this->db->connect_errno) {
            $this->debug->exception("mysqli <br> error no: " . $this->db->connect_errno . "<br> error name: " . $this->db->connect_error . "<br>  " . __METHOD__);
            return false;
        }
        $this->db->query('SET NAMES utf8');
        $this->db->query("set session character_set_connection=utf8;");
        $this->db->query("set session character_set_results=utf8;");
        $this->db->query("set session character_set_client=utf8;");
    }

    public function __destruct() {
        $this->db->close();
    }

    protected function connect() {
        return new mysqli($this->host, $this->user, $this->password, $this->database);
    }

    public function query($query) {

        $result = $this->db->query($query);
        $myArray = [];
        if ($this->db->errno) {
            $this->debug->exception("mysql error   <br> <br> error no: " . $this->db->errno . "<br>error name:" . $this->db->error . "<br>" . __METHOD__);
        }
        while ($row = $result->fetch_array()) {
            $myArray[] = $row;
        }
        $results = json_encode($myArray);
        $this->result = $results;
        return $results;
    }

    private function getTypeFormat($data) {
//        $result = "";
//        if (is_numeric($data)) {
//
//            if (!empty(strpos($data, "."))) {
//                $result = "d";
//                return $result;
//            }
//            $result = "i";
//            return $result;
//        }
//        if (is_string($data)) {
//            $result = "s";
//            return $result;
//        }
        return "s";
    }

    private function makeTypeFormat($arrData) {
        $format = "";
        foreach ($arrData as $data) {
            $format .= $this->getTypeFormat($data);
        }
        return $format;
    }

    public function execute($query, $data) {
        $stmt = $this->db->prepare($query);
        if ($data) {
            $format = $this->makeTypeFormat($data);
            array_unshift($data, $format);
            call_user_func_array(array($stmt, "bind_param"), $this->ref_values($data));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $results;
    }

    public function select($query, $data) {
        $stmt = $this->db->prepare($query);
        if ($data) {
            foreach ($data as &$item) {
                $item = urldecode($item);
            }
            $format = $this->makeTypeFormat($data);
            array_unshift($data, $format);
            call_user_func_array(array($stmt, "bind_param"), $this->ref_values($data));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($this->db->errno) {
            $this->debug->exception("mysql error   <br> <br> error no: " . $this->db->errno . "<br>error name:" . $this->db->error . "<br>" . __METHOD__);
            return false;
        }
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        $this->result = $results;

        return $results;
    }

    public function single($query, $data) {
        $results = $this->select($query, $data);
        $this->result = $results[0];

        return $results[0];
    }

    public function insert($table, $data) {
        if (empty($table) || empty($data)) {
            return false;
        }
        $data = (array) $data;

        foreach ($data as $key => $value) {
            $value = urldecode($value);
            $data[$key] = $value;
        }

        list( $fields, $placeholders, $values, $format ) = $this->prep_query($data);
        array_unshift($values, $format);
        $stmt = $this->db->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");
        call_user_func_array(array($stmt, "bind_param"), $this->ref_values($values));
        $stmt->execute();


        if ($stmt->errno == 0) {
            $this->insert_id = $stmt->insert_id;
            return true;
        }
        $this->debug->exception("mysql insert error   <br> <br> INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})<br>" . __METHOD__);
        return false;
    }

    public function update($table, $data, $where) {
        if (empty($table) || empty($data)) {
            return false;
        }
        foreach ($data as $key => $value) {
            $value = urldecode($value);
            $data[$key] = $value;
        }

        foreach ($where as $key => $value) {
            $value = urldecode($value);
            $where[$key] = $value;
        }


        list( $fields, $placeholders, $values, $format ) = $this->prep_query($data, "update");
        $where_format = "";
        $where_clause = "";
        $where_values = "";
        $count = 0;
        foreach ($where as $field => $value) {
            if ($count > 0) {
                $where_clause .= " AND ";
            }
            $where_format .= $this->getTypeFormat($field);
            $where_clause .= $field . "=?";
            $where_values[] = $value;
            $count++;
        }
        $format .= $where_format;
        array_unshift($values, $format);

        $values = array_merge($values, $where_values);
        $stmt = $this->db->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");
        call_user_func_array(array($stmt, "bind_param"), $this->ref_values($values));
        $stmt->execute();
        if ($stmt->errno == 0) {
            return true;
        }
        $this->debug->exception("mysql update error   <br> <br> INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})<br>" . __METHOD__);
        return false;
    }

    public function delete($table, $where) {
        $where_format = "";
        $where_clause = "";
        $where_values = "";
        $count = 0;

        foreach ($where as $key => $value) {
            $value = urldecode($value);
            $where[$key] = $value;
        }

        foreach ($where as $field => $value) {
            if ($count > 0) {
                $where_clause .= " AND ";
            }
            $where_format .= $this->getTypeFormat($field);
            $where_clause .= $field . "=?";
            $where_values[] = $value;
            $count++;
        }
        array_unshift($where_values, $where_format);
        $stmt = $this->db->prepare("DELETE FROM {$table} WHERE {$where_clause}");
        call_user_func_array(array($stmt, "bind_param"), $this->ref_values($where_values));
        $stmt->execute();
        if ($stmt->errno == 0) {
            return true;
        }
        $this->debug->exception("mysql delete error   <br> <br> INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})<br>" . __METHOD__);
        return false;
    }

//
    private function prep_query($data, $type = 'insert') {
        $fields = '';
        $placeholders = '';
        $values = [];
        $format = "";
        foreach ($data as $field => $value) {
            $fields .= "{$field},";
            $values[] = $value;

            if ($type == 'update') {
                $placeholders .= $field . '=?,';
            } else {
                $placeholders .= '?,';
            }
        }
        $format = $this->makeTypeFormat($values);
        $fields = substr($fields, 0, -1);
        $placeholders = substr($placeholders, 0, -1);

        return array($fields, $placeholders, $values, $format);
    }

    private function ref_values($array) {
        $refs = [];
        foreach ($array as $key => $value) {
            $refs[$key] = &$array[$key];
        }
        return $refs;
    }

    public function getInsertID() {
        return $this->insert_id;
    }

}
