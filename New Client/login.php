<?php
session_start();
include "config.php";
if(!isset($username)){
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$encpassword = md5($password);
$urls=$baseurl."user/login/";
	/*print $_SESSION["token"] . "<br>";
print_r($_SESSION);
print " <br>";*/			
//Login
$myvars = 'UserName=' . $username . '&Password=' . $encpassword;
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "UserName=$username&Password=$encpassword");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);

//Login Response
$response = curl_exec( $chs );
$phpArray = json_decode($response);
}
if (!isset($_SESSION['token'])){
//print $response . "<br>";
//Account Values
$_SESSION["token"] = $phpArray->token;
$_SESSION["userid"] = $phpArray->UserID;
$userid = $_SESSION['userid'];
$token = $_SESSION['token'];
$url2 = $baseurl."user/get_user_info/$token/$userid/0";

$sessionjson2 = file_get_contents($url2);
$phpArray2 = json_decode($sessionjson2);
$_SESSION["username"] = $phpArray2->results->UserName;
$_SESSION["avatar"] = $phpArray2->results->Avatar;
$_SESSION["fullavatar"] = $phpArray2->results->FullPhoto;
$_SESSION["dob"] = $phpArray2->results->BirthDate;
$_SESSION["email"] = $phpArray2->results->Email;
$_SESSION["fbid"] = $phpArray2->results->FacebookID;
$_SESSION["gender"] = $phpArray2->results->Gender;
$_SESSION["points"] = $phpArray2->results->Points;
$_SESSION["admin"] = $phpArray2->results->IsAdmin;
$_SESSION["location"] = $phpArray2->results->NeighborhoodName;
$dob = $_SESSION["dob"];
$_SESSION["birthday"] = date_diff(date_create("$dob"), date_create('today'))->y;
$insertuser = $_SESSION["username"];

$db = new SQLite3('<path to sqlite3 database>');
$headers = apache_request_headers();
}

if(!isset($userid)){
session_unset($_SESSION);
session_destroy();
//header("Location: index.php");
print_r($phpArray);
exit();
}
else{
header("Location: dashboard.php");
//print_r($phpArray2);
}
?>
