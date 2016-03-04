<?php
//backs up post and image locations to database
//include "header.php";
session_start();
$token = $_SESSION["token"];
//$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$db = new SQLite3('db.db');
$sqliteDebug = true;
$userid = $_GET['id'];
$count = 0;
$max = 5;


while ($count < $max){
if (!isset($aid)){
$purl = "http://ws.anomo.com/v210/index.php/webservice/user/get_all_user_post/$token/$userid/0/0";
}else{
$purl = "http://ws.anomo.com/v210/index.php/webservice/user/get_all_user_post/$token/$userid/0/$aid/";
}
print $purl . "<br>";
$profileData = file_get_contents($purl);
//if ($profileData == false){ break;}
$phpArray = json_decode($profileData, true);
$phpArray2 = json_decode($profileData);
$stuff = 0;
//print_r($phpArray2);
//print $profileData;
foreach($phpArray['Activities'] as $item) {
	$posttype = $item['Type'];
//$activityid = $item['ActivityID'];
$activityid = $item['RefID'];
$image = $item['Image'];
$comment = $item['Comment'];
$datetime = $item['CreatedDate'];
$message = $item['Message'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
//$db->exec("INSERT INTO backup (refid, userid, type, message, image, date, comment) VALUES (\"$activityid\", \"$userid\", \"$posttype\", \"$messaged\", \"$image\", \"$datetime\", \"$comment\")");
//if (!$db and $sqliteDebug) {
//	break;
//}
 $stuff++;
 print $activityid . "<br>";
}
//print $profileData;
$stuff--;
/*if ($stuff<8){
$count = $max;
}*/
//$aid = $phpArray2->Activities[$stuff]->ActivityID;

$count++;
}

?>