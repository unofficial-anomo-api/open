<?php
session_start();
include "session.php";
include "header.php";
$minage = $_SESSION["minage"];
$maxage = $_SESSION["maxage"];
$type = $_SESSION["type"];
$gender = $_SESSION["gender"];
$tab = $_SESSION["tab"];
$search = $_POST['search'];
$count = 0;
$max = 30;
$userid = $_SESSION["userid"];
if (isset($search)){
$db = new SQLite3('db.db');
$db->exec("INSERT INTO feedfind (searching, searched) VALUES (\"$search\", \"$userid\")");
while ($count < $max){
$next = 0;
if (!isset($id)){
$purl = "http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $minage . "/" . $maxage . "/0/0";
}else{
$purl = "http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $minage . "/" . $maxage . "/$id/0";
}
//print $purl . "<br>";
echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-1817d58\" href=\"#panel-elemdent-$refid\"><center>Search Status'</center></a>
					</div>
					<div id=\"panel-elemdent-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"feedfind.php\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Search Text</label><input type=\"text\" name=\"search\" class=\"form-control\"/>
					 
				</div>
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
						</div>
					</div></div>";
$profileData = file_get_contents($purl);
$phpArray = json_decode($profileData, true);
$phpArray2 = json_decode($profileData);
//print $profileData;
foreach($phpArray['Activities'] as $item) {
	$stype = $item['Type'];
	$message = $item['Message'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	$image = $item['Image'];
	$like = $item['Like'];
	$next++;
$comment = $item['Comment'];
$photopath_parts = pathinfo($image);
$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
$pic = "/pics/pic.jpg?pic=" . $photofile;
$video = $item['VideoID'];
	$user = $item['FromUserName'];
	$refid = $item['RefID'];

	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	
	$anon = $item['IsAnonymous'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['NeighborhoodName'];
	
	$str = strtolower($messaged);
	if(preg_match("/$search\*?/im", $str)) {
	print "<div class=\"panel panel-default\">";
	if ($anon !== "1"){
echo "<div class=\"media\">
<a href=\"profile.php?id=$userid\" class=\"pull-left\"><img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a><p align=\"right\"><a id=\"modal-$userid\" href=\"#modal-container-$userid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></p>

<div class=\"modal fade\" id=\"modal-container-$userid\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">
<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> <input type=\"hidden\" name=\"follow\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Follow $buttonuser</button></center></form>
					
					<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> <input type=\"hidden\" name=\"block\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Block $buttonuser</button></center></form>
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-$buttonid\" href=\"#panel-element-$buttonid\"><center>Report $buttonuser</center></a>
					<div id=\"panel-element-$buttonid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"feed.php\" method=\"post\">
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
			</div>";
			echo "<div class=\"media-body\">
<h4 class=\"media-heading\">
$user
</h4>
<p>$birthday | $location</p>";
echo nl2br($messaged, false);
echo "<br>";
}
else{
echo "<div class=\"media\">
<div class=\"media-body\">
<h4 class=\"media-heading\">
Anonymous
</h4>";
echo nl2br($messaged, false);
echo " <br>";
}
if ($stype == "27"){
echo "<img src=\"" . $pic . "\" height=\"100%\" width=\"100%\" class=\"media-object\" alt='' />";
}elseif($stype == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}  
echo "</div>
				<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$stype\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li style=\"float: right;\"><a href=\"comment.php?refid=$refid&type=$stype\"><span class=\"badge pull-left\">Comments</span>$comment</a></li>
</div>
</div>";
	
	}

}
//print $next . "<br>";
$next--;
$next--;
$id = $phpArray2->Activities[$next]->ActivityID;
//print $id . "<br>";
$count++;
}
}
include "footer.php";
?>