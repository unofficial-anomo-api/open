<?php
session_start();
include "config.php";
$token = $_SESSION["token"];
$url = $baseurl."module/module_list/" . $token;
//print $url;
$sessionjson = file_get_contents($url);
$sessionArray = json_decode($sessionjson);
//print_r($sessionArray);
$sessionReply = $sessionArray->code;


print $sessionReply . "<br>" . $url;

if(($sessionReply == "INVALID_TOKEN") || ($sessionReply == "FAIL")){
session_unset($_SESSION);
session_destroy();
//header("Location: logout.php");

exit();
}

?>