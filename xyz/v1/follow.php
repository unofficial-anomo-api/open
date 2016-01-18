<?php
include "config.php";
$follow = $_POST['UserID'];
$token = $_POST['Token'];

$furl = "https://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$follow";
$followData = file_get_contents($furl);
echo $followData;
?>