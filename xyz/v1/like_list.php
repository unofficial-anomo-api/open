<?php 
include "config.php";

$url = "https://ws.anomo.com/v210/index.php/webservice/activity/likelist/$token/$refid/$posttype";
$profileData = file_get_contents($url);
$phpArray = json_decode($profileData, true);
echo "<div class=\"panel panel-default\"><h1>Like List</h1>";
foreach($phpArray['likes'] as $item) {
$userid = $item['UserID'];
$username = $item['UserName'];
$avatar = $item['Avatar'];
$path_parts = pathinfo($avatar);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;