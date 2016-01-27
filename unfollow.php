<?php
//standard unfollow function
//session_start();
//include "header.php";
//include "session.php";

$token = $_SESSION["token"];
$userid = $_SESSION["userid"];

$page = 1;
$pages = 2;
$url = "http://ws.anomo.com/v208/index.php/webservice/user/get_list_following/$token/$userid/$page";
print $url;
//$userid = $_SESSION["userid"];
while ($page <= $pages){
$url = "http://ws.anomo.com/v208/index.php/webservice/user/get_list_following/$token/$userid/$page";
print $url . "<br>";
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
$numberfollowing = $phpArray2->NumberOfFollowing;
foreach($phpArray['ListFollowing'] as $item) {
$fuserid = $item['UserID'];
$url = "http://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$fuserid";
$jsonData3 = file_get_contents($url);
$phpArray3 = json_decode($jsonData3, true);
}
$page++;
}
?>