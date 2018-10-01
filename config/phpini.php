<?php

/*
 * license by ubermensch soft
 * mail : master@ubermensch.co.kr  * 
 * site : www.ubms.co.kr * 
 * site : www.devally.co.kr * 
 */

ini_set('display_errors', 0);
ini_set("allow_url_fopen", true);
ini_set("opcache.enable", CConfig::OP_ENABLE); //켜기
ini_set("opcache.memory_consumption", CConfig::OP_MEMORY); //메모리할당
ini_set("opcache.max_accelerated_files", CConfig::OP_MAX_FILES); //파일갯수
ini_set("opcache.revalidate_freq", CConfig::OP_EXPIRE); //갱신초

ini_set("session.save_handler", CConfig::SESS_HANDLER);
ini_set("session.cache_expire", CConfig::SESS_EXPIRE); // 세션 유효시간 : 분 
ini_set("session.gc_maxlifetime", CConfig::SESS_GARBAGE_COLLECTION); // 세션 가비지 컬렉션(로그인시 세션지속 시간) : 초
ini_set("session.use_cookies", CConfig::SESS_COOKIE); //쿠키사용
ini_set("session.cookie_lifetime", CConfig::SESS_EXPIRE); //브라우저종료시
ini_set("session.cookie_path", CConfig::SESS_COOKIE_PATH); //전체
session_save_path(CConfig::MC_HOST . ":" . CConfig::MC_PORT);
session_start();

