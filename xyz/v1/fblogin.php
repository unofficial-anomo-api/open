<?php
include "config.php";
$fbid = $_POST['FacebookID'];
$fbtoken = $_POST['FacebookToken'];
$fbemail = $_POST['FacebookEmail'];
$test = $_POST['test'];

if(is_null($fbid) || is_null($fbtoken) || is_null($fbemail) ||is_null($test))
{
	include "../header.php";
	include "../error.php";
	include "footer.php";
}
else{
$rpost = array(
	'FacebookID' => "$fbid",
	'FbAccessToken' => "$fbtoken",
	'Email' => "$fbemail"
);
$urls= $version . "/user/login_with_fb/";
//print $urls . "<br>" . $myvars;
//print_r($rpost);
$headers = array("Content-Type:multipart/form-data");
$rchs = curl_init( $urls );
curl_setopt( $rchs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rchs, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $rchs );
//print $responses;
$phpArray = json_decode($responses);
//print_r($phpArray);

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
print "\"CoverPhoto\":\"$coverpic\",";
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