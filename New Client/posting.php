<?php
include "config.php";
session_start();
$comment = $_POST['post'];
$messaged = $_POST['messaged'];
$anon = $_POST['anon'];
if(!isset($anon)){
$anon = 0;
}
if (isset($messaged)) {	
$headers = array("Content-Type:multipart/form-data"); 
$post = array(
	'ProfileStatus' => "{\"message\":\"$comment\",\"message_tags\":[]}",
    'IsAnonymous' => "$anon",
	'TopicID' => '1'
);
$urls = $baseurl."user/post_status/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
	header("Location: dashboard.php");
	//print_r($phpArray);
}
?>
