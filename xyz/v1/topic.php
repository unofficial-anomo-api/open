<?php
include "config.php";

if (isset($page)){
$url = "https://ws.anomo.com/v210/index.php/webservice/stream/get_list_topic/" . $token . "/$topic/$page";
} else{
$url = "https://ws.anomo.com/v210/index.php/webservice/stream/get_list_topic/" . $token . "/$topic";
}
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
