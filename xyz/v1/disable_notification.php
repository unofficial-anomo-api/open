<?php
include "config.php";
$ref = $_POST['RefID'];
$token = $_POST['Token'];
$type = $_POST['Type'];

$url = "https://ws.anomo.com/v208/index.php/webservice/comment/stop_receive_notify/$token/$ref/$type";
$jsonData = file_get_contents($url);
echo $jsonData;

?>