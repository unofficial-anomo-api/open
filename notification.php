<?php
//notification list. 
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$userid = $_SESSION["userid"];
$page = $_GET['page'];
if (!isset($page)){
$_SESSION["page"] = 1;
$page = $_SESSION["page"];
}
else{
$_SESSION["page"] = $page;
}

$url = "http://ws.anomo.com/v209/index.php/webservice/push_notification/get_notification_history/$token/0/$page";
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$notifications = $phpArray2->NewNotificationsNumber;
$page = $phpArray2->Page;

$totalpages = $phpArray2->TotalPage;

/*$read = $phpArray2->NotificationHistory[0]->ID;
$rurl = "http://ws.anomo.com/v206/index.php/webservice/push_notification/read/$token/$read/$userid/1";
$readData = file_get_contents($rurl);
$readArray = json_decode($readData);*/
//print_r($readArray);

foreach($phpArray['NotificationHistory'] as $item) {

$type = $item['Type'];
//15 - followed
//18 - commented fan page
//13 - Like
//16 - Mention
//17 - liked your comment
//14 - someone commented on another post
//19 - someone made a fan page
	
$contenttype = $item['ContentType'];
//1 - status
//27 - picture
$contentid = $item['ContentID'];

$id = $item['ID'];
$senduser = $item['SendUserID'];
$viewed = $item['UnView'];
$anon = $item['IsAnonymous'];
$refid = $item['RefID'];
$username = $item['UserName'];

$avatar = $item['Avatar'];
$path_parts = pathinfo($avatar);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;

$postowner = $item['PostOwnerID'];
$postownername = $item['PostOwnerName'];
$isanon = $item['IsAnonymous'];

print "<div class=\"panel panel-default\">
<div class=\"media\">
<a href=\"profile.php?id=$userid\" class=\"pull-left\"><img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a>
<div class=\"media-body\">
<h4 class=\"media-heading\"><br>";
switch($type){
	case "15":
		echo "$username is now following you";
		break;
	case "18":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username commented on your Fan Page.</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
	case "19":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username posted to their Fan Page.</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
	case "13":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username liked your post.</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
	case "17":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username liked your comment.</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
	case "16":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username mentioned you in a post</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
	case "14":
		echo "<a href=\"comment.php?refid=$contentid&type=$contenttype\">$username commented on ";
		echo $postownername;
		echo "'s $bb post</a>
		<a href=\"disable.php?ref=$contentid&type=$contenttype\">Disable Notification</a>";
		break;
}
echo "</h4><br></div></div></div>";
}
$page++;
echo "<form action=\"notification.php\" method=\"get\"> 
<input type=\"hidden\" name=\"page\" value=\"$page\">
<button type=\"submit\" class=\"btn btn-default\">Next Page</button></form>";





?>