<?php
include "config.php";


$url = "https://ws.anomo.com/v209/index.php/webservice/push_notification/get_notification_history/$token/0/$page";
$url = "https://ws.anomo.com/v209/index.php/webservice/push_notification/get_notification_history/$token/0/$page";
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);