<?php
include "config.php";

$report = $_POST['report'];
$reporting = $_POST['reporting'];
$typing = $_POST['typing'];
if(isset($report)){
$headers = array("Content-Type:multipart/form-data"); 
$rpost = array(
	'Content' => "$reporting"
);
$rurls="https://ws.anomo.com/v210/index.php/webservice/flag/content/$token/$report/$typing/0";
$rchs = curl_init( $rurls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$rresponses = curl_exec( $rchs );
}