<?php
include "config.php";
$comment = $_POST['Status'];
$token = $_POST['Token'];
$anon = $_POST['Anonymous'];
$test = $_POST['test'];
if (is_null($anon)){
$anon = 0;
}
if(is_null($comment) || is_null($token) || is_null($anon) || is_null($test))
{
	include "../header.php";
	include "../error.php";
	include "footer.php";
}
else
{

$headers = array("Content-Type:multipart/form-data"); 
$post = array(
	'ProfileStatus' => "{\"message\":\"$comment\",\"message_tags\":[]}",
    'IsAnonymous' => "$anon"
);
//print $comment . "<br><br>" . $anon . "<br><br>" . $token;
$urls = "https://ws.anomo.com/v208/index.php/webservice/user/update/$token";
//print "<br>" . $urls;
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt($chs, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);

//avatar
$fullphoto = $phpArray->results->{'FullPhoto'};
$path_parts = pathinfo($fullphoto);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;

//cover photo
$cover = $phpArray->results->{'CoverPicture'};
$coverpath_parts = pathinfo($cover);
$coverfile =  $coverpath_parts['filename'] . "." . $coverpath_parts['extension']; 
$coverpic = "/pics/pic.jpg?pic=" . $coverfile;

//dob to age
$dob = $phpArray->results->{'BirthDate'};
$birthday = date_diff(date_create("$dob"), date_create('today'))->y;

//add slashes to status
$message = addslashes($phpArray->ProfileStatus);

print "{\"UserID\":\"$phpArray->UserID\",";
print "\"UserName\":\"$phpArray->UserName\",";
print "\"Gender\":\"$phpArray->Gender\",";
print "\"BirthDate\":\"$birthday\",";
print "\"AboutMe\":\"$phpArray->AboutMe\",";
print "\"NeighbourhoodName\":\"$phpArray->NeighborhoodName\",";
print "\"HasFanPage\":\"$fanpage\",";
print "\"Point\":\"$point\",";
print "\"ProfileStatus\":\"$message\",";
print "\"Avatar\":\"$phpArray->Avatar\",";
print "\"FullAvatar\":\"$phpArray->FullPhoto\",";
print "\"CoverPhoto\":\"$phpArray->CoverPicture\",";
print "\"Status\":\"Ok\"}";
}
?>