<?php
session_start();
include "header.php";
include "session.php";
$db = new SQLite3('db.db');
$token = $_SESSION["token"];
$refid = $_GET['refid'];
$prefid = $_POST['prefid'];
$type = $_GET['type'];
$gtype = $type;
$ptype = $_POST['ptype'];
$fav = $_GET['fav'];
$sub = $_GET['sub'];
$liked = $_GET['like'];
$messaged = $_POST['messaged'];
$delid = $_SESSION["userid"];
$delete = $_POST['delete'];
if(isset($delete)){
$furl = "http://ws.anomo.com/v208/index.php/webservice/user/delete_activity/$token/$delete";
$followData = file_get_contents($furl);
//print $furl;
//print "<br>";
//print $followData;
$followArray = json_decode($followData);
}
if($fav == "1"){
$db->exec("INSERT INTO favs (refid, userid, type) VALUES (\"$refid\", \"$delid\", \"$type\")");
echo "inserted<br>";
}
if($sub == "1"){
$db->exec("INSERT INTO subscribe (refid, userid, type) VALUES (\"$refid\", \"$delid\", \"$type\")");
echo "inserted<br>";
}
if($liked == "1"){
$furl = "http://ws.anomo.com/v208/index.php/webservice/activity/like/$token/$refid/$type/false";
$followData = file_get_contents($furl);
//print $furl;
echo $followArray;
}
$follow = $_POST['follow'];
if(isset($follow)){
$furl = "http://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$follow";
$followData = file_get_contents($furl);
//print $url;
$followArray = json_decode($followData);
}
$block = $_POST['block'];

if(isset($block)){
$burl = "http://ws.anomo.com/v208/index.php/webservice/user/block_user/$token/$block";
$blockData = file_get_contents($burl);
//print $url;
$blockArray = json_decode($blockData);
//print_r($blockArray);

}
$report = $_POST['report'];
$reporting = $_POST['reporting'];
$typing = $_POST['typing'];
if(isset($report)){
$headers = array("Content-Type:multipart/form-data"); 
$rpost = array(
	'Content' => "$reporting"
);
$rurls="http://ws.anomo.com/v208/index.php/webservice/flag/content/$token/$report/$typing/0";
$rchs = curl_init( $rurls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$rresponses = curl_exec( $rchs );
}
//print $token;
$content = $_POST['comment'];
$anon = $_POST['anon'];
if(!isset($anon)){
$anon = 0;
}
if (isset($messaged)) {
			
//change pwd
//$post = "Content=" . $content;
$post = array(
	'Content' => "$content",
	'IsAnonymous' => "$anon"
);
$urls="http://ws.anomo.com/v208/index.php/webservice/activity/comment/" . $token . "/" . $prefid . "/" . $ptype;
//print $urls . "<br>";
//print $content . "<br>";
$headers = array("Content-Type:multipart/form-data"); 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
//echo $responses;
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Posted Fan Comment</h4></div>";
}
$url = "http://ws.anomo.com/v208/index.php/webservice/activity/detail/$token/$refid/$type";
$jsonData = file_get_contents($url);
//print $url . "<br>";
$phpArray = json_decode($jsonData, true);
//$phpArray = array_reverse($phpArray['Activity']['ListComment'],true);
//print_r($phpArray['Activity']['ListComment']);
$phpArray2 = json_decode($jsonData);
//print_r($phpArray2);

	$message = $phpArray2->Activity->{'Message'};
	$myanon = $phpArray2->Activity->{'AllowCommentAnonymous'};
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	
	$favatar = $phpArray2->Activity->{'Avatar'};
	$fpath_parts = pathinfo($favatar);
	$favatarfile =  $fpath_parts['filename'] . "." . $fpath_parts['extension']; 
	$favatard = "/pics/avatar.png?avatar=" . $favatarfile;
	
	$fromuser = $phpArray2->Activity->{'FromUserName'};
	
	$image = $phpArray2->Activity->{'Image'};
	$encoded = urlencode($image);
	$photopath_parts = pathinfo($image);
	$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
	$pic = "/pics/pic.jpg?pic=" . $photofile;
	
	$type = $phpArray2->Activity->{'Type'};
	$aid = $phpArray2->Activity->{'ActivityID'};
	$fromid = $phpArray2->Activity->{'FromUserID'};
	$comment = $phpArray2->Activity->{'Comment'};
	$like = $phpArray2->Activity->{'Like'};
	
echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
<div class=\"media\">
<a href=\"profile.php?id=$fromid\" class=\"pull-left\"><img src=\"" . $favatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a><p align=\"right\"><a id=\"modal-$refid\" href=\"#modal-container-$refid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></p>
<div class=\"media-body\">
<h4 class=\"media-heading\">
$fromuser
</h4>$messaged <br>";
if ($type == "27"){
echo "<a href=\"http://images.google.com/searchbyimage?image_url=$encoded\"><img src=\"" . $pic . "\" height=\"90%\" width=\"90%\" class=\"media-object\" alt='' /></a>";
}elseif($type == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}
echo "</div></div>";
if ($ptype !== "29"){
echo "<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$type\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li style=\"float: right;\"><span class=\"badge pull-left\">Comments</span> $comment</li>";
}
echo "</div></div>";
$self = $_SERVER['PHP_SELF'];
$surl = $self . "?refid=" . $refid . "&type=" . $type . "&fav=1";
echo "<div class=\"modal fade\" id=\"modal-container-$refid\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">
					<form class=\"form-horizontal\" action=\"$self\" method=\"get\"> 
<input type=\"hidden\" name=\"refid\" value=\"$refid\">
<input type=\"hidden\" name=\"type\" value=\"$type\">
<input type=\"hidden\" name=\"fav\" value=\"1\">
<center><button type=\"submit\" class=\"btn btn-default btn-block\">Fav Post</button></center></form>
<form class=\"form-horizontal\" action=\"$self\" method=\"get\"> 
<input type=\"hidden\" name=\"refid\" value=\"$refid\">
<input type=\"hidden\" name=\"type\" value=\"$type\">
<input type=\"hidden\" name=\"sub\" value=\"1\">
<center><button type=\"submit\" class=\"btn btn-default btn-block\">Subscribe to Post</button></center></form>
<form class=\"form-horizontal\" action=\"$self\" method=\"get\"> 
<input type=\"hidden\" name=\"refid\" value=\"$refid\">
<input type=\"hidden\" name=\"type\" value=\"$type\">
<input type=\"hidden\" name=\"like\" value=\"1\">
<center><button type=\"submit\" class=\"btn btn-default btn-block\">Like Post</button></center></form>
</div></div></div>";
					
$comment = $phpArray2->Activity->{'Comment'};
$comment--;
$commented = '0';
//print_r($phpArray);
while ($comment >= $commented) {
$user = $phpArray2->Activity->ListComment[$comment]->{'UserName'};
$userid = $phpArray2->Activity->ListComment[$comment]->{'UserID'};
$id = $phpArray2->Activity->ListComment[$comment]->{'ID'};
$dob = $phpArray2->Activity->ListComment[$comment]->{'BirthDate'};
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $phpArray2->Activity->ListComment[$comment]->{'NeighborhoodName'};
$buttonuser = $user;
$buttonid = $userid;
$content = $phpArray2->Activity->ListComment[$comment]->{'Content'};
//$type = $item['Type'];
$NumberOfLike = $phpArray2->Activity->ListComment[$comment]->{'NumberOfLike'};
$avatar = $phpArray2->Activity->ListComment[$comment]->{'Avatar'};
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	$comment--;
echo "<div class=\"panel panel-default\">
<div class=\"media\">
<a href=\"profile.php?id=$userid\" class=\"pull-left\"><img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a><p align=\"right\"><a id=\"modal-$userid\" href=\"#modal-container-$userid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></p>
<div class=\"media-body\">
<h4 class=\"media-heading\">
$user 
</h4>
<p>$birthday | $location</p>";
echo nl2br($content, false);

echo" <br>
<div class=\"modal fade\" id=\"modal-container-$userid\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">";
if($buttonid == $delid){
echo "<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> 
<input type=\"hidden\" name=\"delete\" value=\"$activity\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Delete $username</button></center></form>";
}				
echo			"<form class=\"form-horizontal\" action=\"comment.php?refid=$refid&type=$type\" method=\"post\"> <input type=\"hidden\" name=\"follow\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Follow $buttonuser</button></center></form>
					
					<form class=\"form-horizontal\" action=\"comment.php?refid=$refid&type=$type\" method=\"post\"> <input type=\"hidden\" name=\"block\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Block $buttonuser</button></center></form>
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-$buttonid\" href=\"#panel-element-$buttonid\"><center>Report $buttonuser</center></a>
					<div id=\"panel-element-$buttonid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"comment.php?refid=$refid&type=$type\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Reason</label><input type=\"text\" name=\"reporting\" class=\"form-control\"/>
					 <input type=\"hidden\" name=\"report\" value=\"$buttonid\">
					 <input type=\"hidden\" name=\"reporting\" value=\"$posttype\">
					 </div>
					 </div>
					 
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
						</div>
					
					
						<div class=\"modal-footer\">
							 <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
						</div>
					</div>
					</div>
				</div>
<span style=\"float: right;\">$NumberOfLike <a href=\"clikelist.php?id=$refid\">Likes</a></span>
</div></div></div>
";
}
echo "<div class=\"panel panel-default\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"comment.php?refid=$refid&type=$gtype\" method=\"post\">
				<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Comment</label><textarea name=\"comment\" class=\"form-control counted\" placeholder=\"Type in your comment\" rows=\"5\" style=\"margin-bottom:10px;\"/></textarea>";
					if ($myanon == "1"){
						echo "<label><input type=\"checkbox\" name=\"anon\" value=\"1\" checked=\"yes\"/>Make Anonymous</label>";
					}
					 echo "<input type=\"hidden\" name=\"messaged\" value=\"1\"/>
					 <input type=\"hidden\" name=\"prefid\" value=\"$refid\"/>
					 <input type=\"hidden\" name=\"ptype\" value=\"$gtype\"/>
				</div>
			 <button type=\"submit\" class=\"btn btn-info\">comment</button>
			</form>
						</div>";








?>
