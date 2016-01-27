<?php
//grabs user profile then spits out details. then grabs the users posts and spits them out. There's some added features such as searching through user posts for given text string and reporting the user
session_start();
include "session.php";
include "header.php";
$userid = $_GET['id'];

$aid = $_GET['aid'];
$fuserid= $_POST['fuserid'];
$token = $_SESSION["token"];
$comment = $_POST['comment'];
$messaged = $_POST['messaged'];
$follow = $_POST['follow'];
if(isset($follow)){
$furl = "http://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$follow";
$followData = file_get_contents($furl);
//print $url;
$followArray = json_decode($followData);
}
$fpost = $_GET['fpost'];
if (!isset($fpost)){
$_SESSION["fpost"] = 0;
$fpost = $_SESSION["fpost"];
}
else{
$_SESSION["fpost"] = $fpost;
}
$report = $_POST['report'];
$reporting = $_POST['reporting'];
if(isset($report)){
$headers = array("Content-Type:multipart/form-data"); 
$rpost = array(
	'Content' => "$reporting"
);
$rurls="http://ws.anomo.com/v208/index.php/webservice/flag/add/$token/$report";
$rchs = curl_init( $rurls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$rresponses = curl_exec( $rchs );
}
//if (isset($pwd)){$md5pwd = md5($pwd);}
//print $md5pwd;
//echo "<br>" .$_SESSION["token"];
$anon = $_POST['anon'];
if(!isset($anon)){
$anon = 0;
}
if (isset($messaged)) {
			
//change pwd
$headers = array("Content-Type:multipart/form-data"); 
//$post = "ProfileStatus={\"message\":" . $comment . "\",\"message_tags\":[]}&IsAnonymous=0&FanPage=" . $userid;
//'ProfileStatus' => "{\"message\":\"$comment\",\"message_tags\":[]}\"",
//$comment = FILTER_SANITIZE_SPECIAL_CHARS($comment);
$comments = addslashes($comment);
$post = array(
	'ProfileStatus' => "{\"message\":\"$comment\",\"message_tags\":[]}",
    'IsAnonymous' => "$anon",
    'FanPage' => "$userid"
);
$urls="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION["token"];
//print $urls . "<BR>";
//print_r($post);
//print " <br>";
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Posted Fan Comment</h4></div>";
}
$url="http://ws.anomo.com/v208/index.php/webservice/user/get_user_info/" . $token . "/" . $userid;
$jsonData = file_get_contents($url);
//print $url . "<br>";
$phpArray = json_decode($jsonData);
$username = $phpArray->results->{'UserName'};
$followers = $phpArray->results->{'NumberOfFollower'};
$following = $phpArray->results->{'NumberOfFollowing'};
$points = $phpArray->results->{'Point'};
$credit = $phpArray->results->{'Credits'};
$userid = $phpArray->results->{'UserID'};
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
print "<div class=\"panel panel-default\" style=\"background-image: url($coverpic); background-size: cover;>
<b><font size=\"3\" color=\"blue\">$birthday | $location | C$credit</font></b><p>
<img src=\"$avatard\" align=\"right\" height=\"165px\" width=\"75px\">
<br><br><br><font size=\"6\" color=\"white\">$username</font>
<p><b><font size=\"5\" color=\"blue\"><a href=\"followers.php?userid=$userid\">$followers</a> | <a href=\"following.php?userid=$userid\">$following</a> | <a href=\"points.php?userid=$userid\">$points</a></font><span align=\"right\"><a id=\"modal-$userid\" href=\"#modal-container-$userid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></b></span> </p>


			
<div class=\"modal fade\" id=\"modal-container-$userid\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">

					<form class=\"form-horizontal\" action=\"profile.php\" method=\"post\"> <input type=\"hidden\" name=\"follow\" value=\"$userid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Follow $username</button></center></form>
					
					<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> <input type=\"hidden\" name=\"block\" value=\"$userid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Block $username</button></center></form>
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181d758\" href=\"#panel-element-222\"><center>Report $username</center></a>
					<div id=\"panel-element-222\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"profile.php\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Reason</label><input type=\"text\" name=\"reporting\" class=\"form-control\"/>
					 <input type=\"hidden\" name=\"report\" value=\"$userid\">
					 </div>
					 </div>
					 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
					</form>
					</div>
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181sd758\" href=\"#panel-element-222s\"><center>Search Posts</center></a>
					<div id=\"panel-element-222s\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"postsearch.php\" method=\"get\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Search For</label><input type=\"text\" name=\"search\" class=\"form-control\"/>
					 <input type=\"hidden\" name=\"userid\" value=\"$userid\">
					 </div>
					 </div>
					 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
					</form>
					</div>
						
					
					
						<div class=\"modal-footer\">
							 <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
						</div>
					</div>
					
				</div></div></div>


<center>
				<div class=\"btn-group\">
				 <a href=\"profile.php?fpost=0&id=$userid&aid=$aid\"><button class=\"btn btn-default\" type=\"button\">Posts</button></a>
				 <a href=\"profile.php?fpost=1&id=$userid&aid=$aid\"><button class=\"btn btn-default\" type=\"button\">Fan Page</button></a>
			</div></center><br>";
if($fpost == "1"){
echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181758\" href=\"#panel-element-$refid\"><center>Fan Page</center></a>
					</div>
					<div id=\"panel-element-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"profile.php?id=$userid\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Fan Comment</label><input type=\"text\" name=\"comment\" class=\"form-control\"/>
					 <input type=\"hidden\" name=\"messaged\" value=\"1\">
					 <label><input type=\"checkbox\" name=\"anon\" value=\"1\"/>Make Anonymous</label>
					 
				</div>
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
						</div>
					</div></div>";
}
			
if (!isset($aid)){
$purl = "http://ws.anomo.com/v208/index.php/webservice/user/get_all_user_post/$token/$userid/$fpost/0";
}else{
$purl = "http://ws.anomo.com/v208/index.php/webservice/user/get_all_user_post/$token/$userid/$fpost/$aid/";
}
//print $purl;
$profileData = file_get_contents($purl);
$phpArray = json_decode($profileData, true);
$phpArray2 = json_decode($profileData);
foreach($phpArray['Activities'] as $item) {
$posttype = $item['Type'];
$like = $item['Like'];
$comment = $item['Comment'];
$refid = $item['RefID'];
$activityid = $item['ActivityID'];
$image = $item['Image'];
$encoded = urlencode($image);
$photopath_parts = pathinfo($image);
$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
$pic = "/pics/pic.jpg?pic=" . $photofile;
$epic = "http://". $_SERVER["SERVER_NAME"] . "/" . $pic;
$encoded = urlencode($epic);
$video = $item['VideoID'];
$username = $item['FromUserName'];
$message = $item['Message'];
$phpArray3 = json_decode($message);
$messaged = $phpArray3->{'message'};
print "<div class=\"panel panel-default\">
<div class=\"media\">
<p align=\"right\"><a href=\"feed.php?id=$activityid\">Context</a></p>
<div class=\"media-body\">";
echo nl2br($messaged, false);
echo" <br>";
if ($posttype == "27"){
echo "<a href=\"http://images.google.com/searchbyimage?image_url=$encoded\"><img src=\"" . $pic . "\" height=\"100%\" width=\"100%\" class=\"media-object\" alt='' /></a>";
}elseif($posttype == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}  
echo "</div>
				<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$posttype\"><span class=\"badge pull-right\">Likes</span>$like</a></li> 
				<li style=\"float: right;\"><a href=\"comment.php?refid=$refid&type=$posttype\"><span class=\"badge pull-left\">Comments</span>$comment</a></li>
</div>
</div>";
}
$next = $phpArray2->Activities[9]->ActivityID;
echo "<form action=\"profile.php\" method=\"get\"> 
<input type=\"hidden\" name=\"id\" value=\"$userid\">
<input type=\"hidden\" name=\"aid\" value=\"$next\">
<button type=\"submit\" class=\"btn btn-default\">Next Page</button></form>";

?>










<?php include "footer.php"; ?>