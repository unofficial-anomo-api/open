<?php
//lists users that like a particular post
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$refid = $_GET['refid'];
$posttype = $_GET['type'];
$url = "http://ws.anomo.com/v210/index.php/webservice/activity/likelist/$token/$refid/$posttype";
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
print "

<div class=\"media\">
<a href=\"profile.php?id=$userid\" class=\"pull-left\"><img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' />
<div class=\"media-body\">
<h4 class=\"media-heading\">
$username
</h4></a><br></div>
</div>";
}
echo "</div>";
?>