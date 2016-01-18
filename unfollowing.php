<?php
//session_start();
//include "header.php";
//include "session.php";

$token = $_SESSION["token"];
$userid = $_SESSION["userid"];

$page = 1;
$pages = 2;
$url = "https://ws.anomo.com/v208/index.php/webservice/user/get_list_follower/$token/$userid/$page";
print $url;
//$userid = $_SESSION["userid"];
while ($page <= $pages){
$url = "https://ws.anomo.com/v208/index.php/webservice/user/get_list_follower/$token/$userid/$page";
print $url . "<br>";
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
$numberfollowing = $phpArray2->NumberOfFollower;
foreach($phpArray['ListFollower'] as $item) {
$fuserid = $item['UserID'];
$url = "https://ws.anomo.com/v208/index.php/webservice/user/block_user/$token/$fuserid";
$jsonData3 = file_get_contents($url);
$url = "https://ws.anomo.com/v208/index.php/webservice/user/block_user/$token/$fuserid";
$jsonData3 = file_get_contents($url);
$phpArray3 = json_decode($jsonData3, true);
}
$page++;
}
?>