<?php
include "config.php";
$username = $_POST['UserName'];
$password = $_POST['Password'];
$test = $_POST['test'];


if(is_null($username) || is_null($password) || is_null($test))
{
	include "../header.php";
	include "../error.php";
	include "footer.php";
}
else
{
if(!is_null($password)){
$encpassword = md5($password);
}else{
	$encpassword = trim($_POST['EncPassword']);
}
$urls= $version . "/user/login/";
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
//print $response;
//print_r($phpArray);
//if(isset($password)){print "hmmm";}
//dob to age
$dob = $phpArray->BirthDate;
$birthday = date_diff(date_create("$dob"), date_create('today'))->y;

//full avatar proxy
$fullphoto = $phpArray->FullPhoto;
$path_parts = pathinfo($fullphoto);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$fullavatar = "/pics/avatar.png?avatar=" . $avatarfile;

//avatar proxy
$avatarphoto = $phpArray->Avatar;
$path_part = pathinfo($avatarphoto);
$avatardfile =  $path_part['filename'] . "." . $path_part['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatardfile;

//cover proxy
$cover = $phpArray->CoverPicture;
$coverpath_parts = pathinfo($cover);
$coverfile =  $coverpath_parts['filename'] . "." . $coverpath_parts['extension']; 
$coverpic = "/pics/pic.jpg?pic=" . $coverfile;

print "{\"UserID\":\"$phpArray->UserID\",";
print "\"UserName\":\"$phpArray->UserName\",";
print "\"Gender\":\"$phpArray->Gender\",";
print "\"BirthDate\":\"$birthday\",";
print "\"AboutMe\":\"$phpArray->AboutMe\",";
print "\"NeighbourhoodName\":\"$phpArray->NeighborhoodName\",";
print "\"Avatar\":\"$avatard\",";
print "\"FullAvatar\":\"$fullavatar\",";
print "\"CoverPhoto\":\"$overpicphpArray->CoverPicture\",";
print "\"AllowRevealNotice\":\"$phpArray->AllowRevealNotice\",";
print "\"AllowChatNotice\":\"$phpArray->AllowChatNotice\",";
print "\"AllowAnomotionNotice\":\"$phpArray->AllowAnomotionNotice\",";
print "\"AllowCommentActivityNotice\":\"$phpArray->AllowCommentActivityNotice\",";
print "\"AllowLikeActivityNotice\":\"$phpArray->AllowLikeActivityNotice\",";
print "\"AllowFollowNotice\":\"$phpArray->AllowFollowNotice\",";
print "\"OnlyShowCountry\":\"$phpArray->OnlyShowCountry\",";
print "\"token\":\"$phpArray->token\",";
print "\"Status\":\"Ok\"}";
}

?>