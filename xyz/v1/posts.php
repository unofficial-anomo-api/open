<?php
include "config.php";
$token = $_POST['Token'];
$userid = $_POST['UserID']; 
$fanpage = $_POST['FanPage'];
if (!isset($fanpage)){
$fanpage = 0;
}

if (!isset($aid)){
$purl = $version . "/user/get_all_user_post/$token/$userid/$fanpage/0";
}else{
$purl = $version . "/get_all_user_post/$token/$userid/$fanpage/$aid/";
}
//print $purl;
$profileData = file_get_contents($purl);
$phpArray = json_decode($profileData, true);

print "{\"Activities\":[";
foreach($phpArray['Activities'] as $item) {

//strip json from Message
$message = addslashes($item['Message']);
$phpArray3 = json_decode($message);
$messaged = $phpArray3->{'message'};

//pics
$image = $item['Image'];
$encoded = urlencode($image);
$photopath_parts = pathinfo($image);
$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
$pic = "/pics/pic.jpg?pic=" . $photofile;

//convert dob to age
$dob = $phpArray->results->{'BirthDate'};
$birthday = date_diff(date_create("$dob"), date_create('today'))->y;

//proxy pics
$avatar = $item['Avatar'];
$path_parts = pathinfo($avatar);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;

$userid = $item['FromUserID'];
$activityid = $item['ActivityID'];
$username = $item['FromUserName'];
$refid = $item['RefID'];
$type = $item['Type'];
$created = $item['CreatedDate'];
$gender = $item['Gender'];
$fanpage = $item['FanPage'];
$videoid = $item['VideoID'];
$videosource = $item['VideoSource'];
$videothumbnail = $item['VideoThumbnail'];
$fb = $item['FacebookID'];
$islike = $item['IsLike'];
$iscomment = $item['IsComment'];
$comment = $item['Comment'];
$like = $item['Like'];
print "{\"ActivityID\":\"$activityid\",";
print "\"UserID\":\"$userid\",";
print "\"UserName\":\"$username\",";
print "\"Message\":\"$message\",";
print "\"Image\":\"$pic\",";
print "\"RefID\":\"$refid\",";
print "\"Type\":\"$type\",";
print "\"Created\":\"$created\",";
print "\"Gender\":\"$gender\",";
print "\"Age\":\"$birthday\",";
print "\"FanPage\":\"$fanpage\",";
print "\"VideoID\":\"$videoid\",";
print "\"VideoSource\":\"$videosource\",";
print "\"VideoThumbnail\":\"$videothumbnail\",";
print "\"Avatar\":\"$avatard\",";
print "\"FacebookID\":\"$fb\",";
print "\"IsLike\":\"$islike\",";
print "\"IsComment\":\"$iscomment\",";
print "\"Comment\":\"$comment\",";
print "\"Like\":\"$like\"},";
}
print "],\"Status\":\"OK\"}";

?>