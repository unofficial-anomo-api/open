<?php
include "config.php";

if (isset($next)){
$urls = "https://ws.anomo.com/v208/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/" . $lats . "/" . $lons . "/" . $next . "/0/18/100";
}else{
$urls = "https://ws.anomo.com/v208/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/" . $lats . "/" . $lons . "/1/0/18/100";
}

$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
// curl_setopt ($chs, CURLOPT_POSTFIELDS, "Keyword=$user");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);

//Login Response
$response = curl_exec( $chs );
$phpArray = json_decode($response, true);

foreach($phpArray['results']['ListUser'] as $item) {
	$user = $item['UserName'];
	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	$profileid = $item['UserID'];
	$dob = $item['BirthDate'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['PlaceName'];
	
}