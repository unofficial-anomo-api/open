<?php
//searches through a users profile for a given string for 50 pages * 23 posts per page
session_start();
include "session.php";
include "header.php";
$userid = $_GET['userid'];
$search = $_GET['search'];
$searched = $_SESSION['userid'];
$count = 0;
$max = 50;
$url="https://ws.anomo.com/v210/index.php/webservice/user/get_user_info/" . $token . "/" . $userid;
$jsonData = file_get_contents($url);
//print $url . "<br>";
$phpArray = json_decode($jsonData);
$username = $phpArray->results->{'UserName'};
$followers = $phpArray->results->{'NumberOfFollower'};
$following = $phpArray->results->{'NumberOfFollowing'};
$points = $phpArray->results->{'Point'};
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
print "<div class=\"panel panel-default\" style=\"background-image: url($coverpic); height: 175px; width: 343px;\">
<b><font size=\"3\" color=\"blue\">$birthday | $location</font></b><p>
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
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181sd758\" href=\"#panel-element-222s\"><center>Post Search</center></a>
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
if (isset($userid, $search)){
while ($count < $max){
if (!isset($aid)){
$purl = "https://ws.anomo.com/v210/index.php/webservice/user/get_all_user_post/$token/$userid/0/0";
}else{
$purl = "https://ws.anomo.com/v210/index.php/webservice/user/get_all_user_post/$token/$userid/0/$aid/";
}
//print $purl;
$profileData = file_get_contents($purl);
$phpArray = json_decode($profileData, true);
$phpArray2 = json_decode($profileData);
//print $profileData;
foreach($phpArray['Activities'] as $item) {
	$type = $item['Type'];
	$message = $item['Message'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	$image = $item['Image'];
	$like = $item['Like'];
$comment = $item['Comment'];
$photopath_parts = pathinfo($image);
$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
$pic = "/pics/pic.jpg?pic=" . $photofile;
$video = $item['VideoID'];
	$user = $item['FromUserName'];
	$refid = $item['RefID'];
	$str = strtolower($messaged);
	if(preg_match("/$search\*?/im", $str)) {
	print "<div class=\"panel panel-default\">
<div class=\"media\">
<div class=\"media-body\">
$messaged <br>";
if ($type == "27"){
echo "<img src=\"" . $pic . "\" height=\"100%\" width=\"100%\" class=\"media-object\" alt='' />";
}elseif($type == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}  
echo "</div>
				<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$type\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li style=\"float: right;\"><a href=\"comment.php?refid=$refid&type=$type\"><span class=\"badge pull-left\">Comments</span>$comment</a></li>
</div>
</div>";
	
	}

}
$aid = $phpArray2->Activities[9]->ActivityID;
$count++;
}
}
include "footer.php";
?>