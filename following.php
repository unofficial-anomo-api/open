<?php
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];

$page = $_GET['page'];
if (!isset($page)){
$_SESSION["page"] = 1;
$page = $_SESSION["page"];
}
else{
$_SESSION["page"] = $page;
}
$userid = $_GET['userid'];
if (!isset($userid)){
$userid = $_SESSION['userid'];
}
$url = "http://ws.anomo.com/v208/index.php/webservice/user/get_list_following/$token/$userid/$page";
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
$numberfollowing = $phpArray2->NumberOfFollowing;
foreach($phpArray['ListFollowing'] as $item) {
$fuserid = $item['UserID'];
$username = $item['UserName'];
$avatar = $item['Avatar'];
$dob = $item['BirthDate'];
$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
$location = $item['NeighborhoodName'];
$path_parts = pathinfo($avatar);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
echo "<div class=\"panel panel-default\">
<div class=\"media-body\">
<div class=\"media\">
<a href=\"profile.php?id=$fuserid\" class=\"pull-left\">
<img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' />$username</a>
<p align=\"right\"><a>Unfollow</a><br>$birthday | $location </p>
</div></div></div>";








}






$prev = $page;
$prev--;
if($prev > 1){
echo "<form class=\"form-horizontal\" action=\"following.php?userid=$userid\" method=\"get\"> <input type=\"hidden\" name=\"page\" value=\"$prev\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Previous</button></center></form>";
}
$page++;
if($page < $pages){
echo "<form class=\"form-horizontal\" action=\"following.php?userid=$userid\" method=\"get\"> <input type=\"hidden\" name=\"page\" value=\"$page\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Next</button></center></form>";
}
?>