<?php

/*
 * www.ubermensch.co.kr
 * master@ubermensch.co.kr * 
 */

$ARR_URI[0] = strtolower($_SERVER['REQUEST_URI']);
$ARR_URI[1] = strip_tags($ARR_URI[0]);
$ARR_URI[2] = htmlspecialchars($ARR_URI[1]);
$ARR_URI[3] = preg_replace("/[ \+\-@=\\;,'\"\^`~|\!\*$<>()\[\]\{\}]/i", "", $ARR_URI[2]);
$_SERVER['REQUEST_URI'] = $ARR_URI[3];
unset($ARR_URI);
