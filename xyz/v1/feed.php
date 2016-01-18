<?php
include "config.php";

$url = "https://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $min . "/" . $max . "/0/0";
}else{
$url = "https://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $min . "/" . $max . "/$id/0";
}
$jsonData = file_get_contents($url);

$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);

foreach($phpArray['Activities'] as $item) {
	$posttype = $item['Type'];
	$comment = $item['Comment'];
	$like = $item['Like'];
	$dob = $item['BirthDate'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['NeighborhoodName'];
	
	$message = $item['Message'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	
	$activity = $item['ActivityID'];
	$fanpage = $item['FanPage'];
	$aboutuser = $item['AboutName'];
	
	$tag = $phpArray3->{'message_tags'};
	$phpArray4 = json_decode($tag);
	$tagID = $phpArray4->{'id'};
	$tagName = $phpArray4->{'name'};
	
	$userid = $item['FromUserID'];
	$anon = $item['IsAnonymous'];
	$content = $item['Content'];
	
	$next++;
	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	
	$user = $item['FromUserName'];
	$video = $item['VideoID'];
	$buttonuser = $user;
	$buttonid = $userid;
	
	$image = $item['Image'];
	// $encoded = urlencode($image);
	$photopath_parts = pathinfo($image);
	$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
	$pic = "/pics/pic.jpg?pic=" . $photofile;
	$epic = "http://nuiikit.com/" . $pic;
	$encoded = urlencode($epic);
	$refid = $item['RefID'];