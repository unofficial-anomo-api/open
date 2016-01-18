<?php
include "config.php";

$url = "https://ws.anomo.com/v208/index.php/webservice/user/get_list_following/$token/$userid/$page";
$jsonData = file_get_contents($url);