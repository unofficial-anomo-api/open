<?php
include "config.php";
$token = $_GET['Token'];
$userid = $_GET['UserID'];
$test = $_GET['Test'];
if(is_null($token) || is_null($user) || is_null($test))
{
	include "../header.php";
	include "../error.php";
	include "footer.php";
}
else
{
$url= $version . "/user/get_user_info/" . $token . "/" . $userid;
$jsonData = file_get_contents($url);
//print $url . "<br>";
$phpArray = json_decode($jsonData);
$username = $phpArray->results->{'UserName'};
$gender = $phpArray->results->{'Gender'};
$followers = $phpArray->results->{'NumberOfFollower'};
$following = $phpArray->results->{'NumberOfFollowing'};
$userid = $phpArray->results->{'UserID'};
$point = $phpArray->results->{'Point'};
$fanpage = $phpArray->results->{'HasFanPage'};
$aboutme = $phpArray->results->{'AboutMe'};
$fullphoto = $phpArray->results->{'FullPhoto'};
$dob = $phpArray->results->{'BirthDate'};
$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
$location = $phpArray->results->{'NeighborhoodName'};
$path_parts = pathinfo($fullphoto);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
$cover = $phpArray->results->{'CoverPicture'};
$coverpath_parts = pathinfo($cover);
$coverfile =  $coverpath_parts['filename'] . "." . $coverpath_parts['extension']; 
$coverpic = "/pics/pic.jpg?pic=" . $coverfile;
$neighbourhood = $phpArray->results->{'NeighborhoodName'};

print "{\"UserID\":\"$userid\",";
print "\"UserName\":\"$username\",";
print "\"Gender\":\"$gender\",";
print "\"Age\":\"$birthday\",\"Numb";
print "erOfFollowing\":\"$following\",";
print "\"NumberOfFollowers\":\"$followers\",";
print "\"Point\":\"$point\",";
print "\"HasFanPage\":\"$fanpage\",";
print "\"AboutMe\":\"$aboutme\",";
print "\"Avatar\":\"$avatard\",";
print "\"CoverPhoto\":\"$coverpic\",";
print "\"NeighbourhoodName\":\"$neighbourhood\",";
print "\"Status\":\"Ok\"}";
}
?>