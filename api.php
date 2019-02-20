<?php

require_once("configure.php");

global $API_SERVER_IP, $API_SERVER_PORT;

if (!array_key_exists('url',$_REQUEST))  exit;


print json_encode(json_decode(file_get_contents(sprintf("http://%s:%s/?url=%s",$API_SERVER_IP,$API_SERVER_PORT,urlencode($_REQUEST['url'])))),JSON_PRETTY_PRINT);



?>
