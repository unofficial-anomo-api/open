<?php
session_start();
include "session.php";
$token = $_SESSION["token"];
$userid = $_SESSION["userid"];
$ref = $_GET['ref'];
$type = $_GET['type'];
$url = "http://ws.anomo.com/v208/index.php/webservice/comment/stop_receive_notify/$token/$ref/$type";
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
header("Location: notification.php");
?>
