<?php
include "config.php";
$delete = $_POST['ActivityID'];
$token = $_POST['Token'];

$furl = "https://ws.anomo.com/v210/index.php/webservice/user/delete_activity/$token/$delete";
$deleteData = file_get_contents($furl);
echo $deleteData;
?>