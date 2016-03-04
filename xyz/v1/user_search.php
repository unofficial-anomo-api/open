<?php
include "config.php";
$token = $_POST['Token'];
$userid = $_POST['UserID'];
$user = $_POST['Keyword'];
$page = $_POST['Page'];
$test = $_POST['Test'];

if(is_null($token) ||  is_null($test))
{
	include "../header.php";
	include "../error.php";
	include "footer.php";
}
else
{
if (isset($page)){
$urls = "https://ws.anomo.com/v210/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/null/null/" . $page . "/0/18/100";
}else{
$urls = "https://ws.anomo.com/v210/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/null/null/1/0/18/100";
}
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Keyword=$user");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response, true);
$phpArray2 = json_decode($response);
//$print $response;
//print_r($phpArray);
$currentpage = $phpArray2->results->CurrentPage;
$totalpages = $phpArray2->results->TotalPage;
print "{\"results\":{\"ListUser\":[";
foreach($phpArray['results']['ListUser'] as $item) {
	$userid = $item['UserID'];
	$username = $item['UserName'];
	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	$dob = $item['BirthDate'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['PlaceName'];
	$gender = $item['Gender'];
print "{\"UserID\":\"$userid\",";
print "\"UserName\":\"$username\",";
print "\"Gender\":\"$gender\",";
print "\"Age\":\"$birthday\",";
print "\"Avatar\":\"$avatard\",";
print "\"Location\":\"$location\"},";
}
print "],\"CurrentPage\":\"$currentpage\",\"TotalPage\":\"$totalpages\"},\"code\":\"OK\"}";
}
?>