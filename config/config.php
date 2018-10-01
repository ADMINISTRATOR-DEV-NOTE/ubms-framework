<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

class CConfig {

    // only php 7.0 enable !!!
    const ROUTE_TYPE = "mvc"; // select one "rest" or "mvc" 
    //folder path 
    const PATH_APP = "../app/";
    const PATH_MODEL = "../app/model/";
    const PATH_VIEW = "../app/view/";
    const PATH_CONTROL = "../app/control/";
    const PATH_RESOURCE = "../app/control/";
    const PATH_LIB = "../lib/";
    //debug
    const DEBUG = true; // exception true/false flag  , debug time true but must set false in service time 
    const FILE_NOT_FOUND_PATH = "/file_not_found.html"; // 404 error path
    //db info
    const DB_USER = "";
    const DB_PASSWD = "";
    const DB_SCHEMA = "";
    const DB_HOST = "localhost";
    const DB_PORT = 3306;
    //session
    const SESS_HANDLER = "memcached"; //as possible as  do not use file session
    const SESS_EXPIRE = 0;
    const SESS_GARBAGE_COLLECTION = 43200; // eg: 60*60*24*30*12 <-- 1year
    const SESS_COOKIE = 1;
    const SESS_COOKIE_PATH = "/";
    // memcache
    const MC_HOST = "localhost"; // installed memcached server ip 
    const MC_PORT = 11211;
    //  opcache
    const OP_ENABLE = 0; // 0 is off 1 is on  ,recommand set 0 during on dev time 
    const OP_MEMORY = 1024;
    const OP_MAX_FILES = 10000;
    const OP_EXPIRE = 60; //60 second opcache
    // mosquitto 
    const MQ_HOST = ""; //mqtt installed server ip
    const MQ_PORT = 1883;
    //index
    const DEFAULT_CONTORL = "index"; //if no exist target function , controller finds default function 
    const DEFAULT_METHOD = "index";
    const DEFAULT_RESOURCE = "index";
    //control 
    const PREFIX_GET = "get"; //this is called-function's prefix  that matched by http-method($_SERVER['REQUEST_METHOD']) type when ROUTE_TYPE is 'rest'  
    const PREFIX_POST = "post";
    const PREFIX_UPDATE = "update";
    const PREFIX_DELETE = "delete";
    const PREFIX_PUT = "put";
    //
    const SOA_API_SERVER = "http://api.edu.ubms.kr";  //caution !! must not type slash('/') at the end of url  
    const IMG_UPLOAD_SERVER = "http://img.choeen.com"; //recommand put images on the other location server 
    //AES CRYPTO
    const AES_PASSWORD = "MASTERUBERMENSCH"; //aes password  
    //iamport
    const IMP_HOST = "https://api.iamport.kr"; // korean pg service company optional
    const IMP_STORE_ID = "";
    const IMP_KEY = "";
    const IMP_SECRET = "";
    //filter string uri request
    const FILTER_STRING_URI = array("(", ")", "<", ">", ";"); //array in const , only php 7.0 enable expression 
    //fcm
    const FCM_SERVER_KEY = ""; //google service option

}
