<?php
include "config.php";

$furl = "https://ws.anomo.com/v208/index.php/webservice/activity/like/$token/$refid/$type/false";
$followData = file_get_contents($furl);