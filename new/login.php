<?php
session_start();
$utoken = $_GET['token'];
//print $_SESSION['token'];
if(isset($utoken)){
$tokensurl="https://ws.anomo.com/v208/index.php/webservice/user/update/" . $utoken;
$tokenjson = file_get_contents($tokenurl);
$phpArray = json_decode($tokenjson);
//print_r($phpArray);
}
elseif(!isset($username)){
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$encpassword = md5($password);
$urls="https://ws.anomo.com/v208/index.php/webservice/user/login/";
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
$_SESSION["username"] = $phpArray->UserName;

$avatar = $phpArray->Avatar;
$apath_parts = pathinfo($avatar);
$avatarfilea =  $apath_parts['filename'] . "." . $apath_parts['extension']; 
$_SESSION["avatar"] = "/pics/avatar.png?avatar=" . $avatarfilea;

$fullphoto = $phpArray->FullPhoto;
$path_parts = pathinfo($fullphoto);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$_SESSION["fullphoto"] = "/pics/avatar.png?avatar=" . $avatarfile;

$_SESSION["birthday"] = $phpArray->BirthDate;
$_SESSION["email"] = $phpArray->Email;
$_SESSION["fbid"] = $phpArray->FacebookID;
$_SESSION["gender"] = $phpArray->Gender;
$insertuser = $_SESSION["username"];
$insertuserid = $_SESSION['userid'];

$headers = apache_request_headers();
if (array_key_exists('X-Forwarded-For', $headers)){
  $hostname=$headers['X-Forwarded-For'] . ' via ' . $_SERVER["REMOTE_ADDR"];
} else {
  $hostname=$_SERVER["REMOTE_ADDR"];
}


}
//print "token " . $_SESSION["token"] . "<br>";
//print $_SESSION['token'];
$sessionsurl="https://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION['token'];
$sessionjson = file_get_contents($sessionsurl);
$sessionArray = json_decode($sessionjson);
$sessionReply = $sessionArray->code;
print $sessionReply;
if(($sessionReply == "INVALID_TOKEN") || ($sessionReply == "FAIL")){
session_unset($_SESSION);
session_destroy();
header("Location: index.php?login=fail");

exit();
}
else{
header("Location: avatar.php");
}
?>
